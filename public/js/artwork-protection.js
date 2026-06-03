/**
 * Artwork preview protection — discourages right-click, drag, copy, and direct image interaction.
 * Does not block OS-level screenshots.
 */
(function (window, document) {
    'use strict';

    var EXCLUDE_ANCESTOR =
        'button, input, select, textarea, label, .primary_file_uploader, [data-toggle="amazuploader"], .img_remove_btn, .compact-color-input, #palette_color, .product_action, .artwork-protect-exempt';

    var AUTO_ZONE_SELECTORS = [
        '.artwork-protect-zone',
        '.slider-container.slick_custom_container',
        '.product_thumb_upper > a.thumb',
        '.artists-list-card__thumb-slot:not(.artists-list-card__thumb-slot--empty)',
        '.product_details_img.artwork-protect-zone',
    ];

    function closestZone(node) {
        if (!node || !node.closest) {
            return null;
        }
        for (var i = 0; i < AUTO_ZONE_SELECTORS.length; i++) {
            var match = node.closest(AUTO_ZONE_SELECTORS[i]);
            if (match) {
                return match;
            }
        }
        return node.closest('.artwork-protect-zone');
    }

    function shouldSkip(node) {
        if (!node || node.nodeType !== 1) {
            return true;
        }
        if (node.classList && node.classList.contains('artwork-protect-exempt')) {
            return true;
        }
        if (node.closest && node.closest('.artwork-protected__frame, .artwork-protected--bg')) {
            return true;
        }
        if (node.closest && node.closest(EXCLUDE_ANCESTOR)) {
            return true;
        }
        return false;
    }

    function wrapImage(img) {
        if (shouldSkip(img) || img.closest('.artwork-protected__frame')) {
            return;
        }

        var frame = document.createElement('div');
        frame.className = 'artwork-protected__frame';
        img.parentNode.insertBefore(frame, img);
        frame.appendChild(img);

        img.classList.add('artwork-protected__img');
        img.setAttribute('draggable', 'false');
        img.setAttribute('oncontextmenu', 'return false;');

        var shield = document.createElement('div');
        shield.className = 'artwork-protected__shield';
        shield.setAttribute('aria-hidden', 'true');
        frame.appendChild(shield);

        var watermark = document.createElement('div');
        watermark.className = 'artwork-protected__watermark';
        watermark.setAttribute('aria-hidden', 'true');
        watermark.textContent = 'Protected Preview';
        frame.appendChild(watermark);
    }

    function protectBackground(el) {
        if (shouldSkip(el) || el.classList.contains('artwork-protected--bg')) {
            return;
        }

        el.classList.add('artwork-protected', 'artwork-protected--bg');

        if (el.querySelector('.artwork-protected__shield')) {
            return;
        }

        var shield = document.createElement('div');
        shield.className = 'artwork-protected__shield';
        shield.setAttribute('aria-hidden', 'true');
        el.appendChild(shield);

        var watermark = document.createElement('div');
        watermark.className = 'artwork-protected__watermark';
        watermark.setAttribute('aria-hidden', 'true');
        watermark.textContent = 'Protected Preview';
        el.appendChild(watermark);
    }

    function protectZone(zone) {
        if (!zone) {
            return;
        }

        zone.querySelectorAll('img').forEach(function (img) {
            wrapImage(img);
        });

        zone.querySelectorAll('.product_details_img').forEach(function (el) {
            protectBackground(el);
        });
    }

    function collectZones(root) {
        root = root || document;
        var zones = [];

        AUTO_ZONE_SELECTORS.forEach(function (selector) {
            root.querySelectorAll(selector).forEach(function (zone) {
                if (zones.indexOf(zone) === -1) {
                    zones.push(zone);
                }
            });
        });

        return zones;
    }

    function refresh(root) {
        collectZones(root).forEach(protectZone);
    }

    function blockEvent(event) {
        var target = event.target;
        if (
            target.closest('.artwork-protected__frame') ||
            target.closest('.artwork-protected--bg')
        ) {
            event.preventDefault();
            return false;
        }
    }

    function initEvents() {
        document.addEventListener('contextmenu', blockEvent, true);
        document.addEventListener('dragstart', blockEvent, true);
        document.addEventListener('selectstart', blockEvent, true);
        document.addEventListener(
            'copy',
            function (event) {
                var selection = window.getSelection();
                if (!selection || selection.rangeCount === 0) {
                    return;
                }
                var node = selection.anchorNode;
                if (node && node.nodeType === 3) {
                    node = node.parentNode;
                }
                if (
                    node &&
                    node.closest &&
                    node.closest('.artwork-protected__frame, .artwork-protected--bg')
                ) {
                    event.preventDefault();
                }
            },
            true
        );
    }

    function initObserver() {
        if (!window.MutationObserver) {
            return;
        }

        var timer = null;
        var observer = new MutationObserver(function (mutations) {
            var needsRefresh = false;

            mutations.forEach(function (mutation) {
                if (mutation.type === 'childList' && mutation.addedNodes.length) {
                    needsRefresh = true;
                }
                if (
                    mutation.type === 'attributes' &&
                    mutation.target.classList &&
                    mutation.target.classList.contains('product_details_img')
                ) {
                    protectBackground(mutation.target);
                }
            });

            if (needsRefresh) {
                clearTimeout(timer);
                timer = setTimeout(function () {
                    refresh(document);
                }, 50);
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['style', 'class'],
        });
    }

    function init() {
        initEvents();
        refresh(document);
        initObserver();
    }

    window.ArtworkProtection = {
        refresh: refresh,
        init: init,
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})(window, document);
