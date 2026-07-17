@php
    $announcementMessage = __('defaultTheme.new_website_announcement', [
        'contact_link' => ' <a href="' . e(url('/contact-us')) . '" class="site-announcement-strip__link">' . e(__('defaultTheme.contact_us')) . '</a> ',
    ]);
@endphp

@once
<style>
    .header__left.site-announcement-wrap {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        max-width: calc(100% - 120px);
    }

    @media (min-width: 992px) and (max-width: 1199.98px) {
        header.amazcartui_header .header_area .header_topbar_area .header__wrapper .header__left.site-announcement-wrap {
            display: flex !important;
        }
    }

    .site-announcement-strip {
        flex: 1 1 auto;
        min-width: 0;
        overflow: hidden;
        width: 100%;
    }

    .site-announcement-strip__viewport {
        overflow: hidden;
        width: 100%;
    }

    .site-announcement-strip__track {
        display: flex;
        width: max-content;
        animation: siteAnnouncementScroll 90s linear infinite;
        will-change: transform;
    }

    .site-announcement-strip__track:hover {
        animation-play-state: paused;
    }

    .site-announcement-strip__item {
        display: inline-flex;
        align-items: center;
        white-space: nowrap;
        height: 40px;
        font-size: 12px;
        font-weight: 500;
        line-height: 1.4;
        color: var(--text_color, #333);
        letter-spacing: 0.01em;
        text-transform: none;
    }

    .site-announcement-strip__item + .site-announcement-strip__item {
        padding-left: 80px;
    }

    .site-announcement-strip__link {
        color: var(--base_color, #fd4949);
        text-decoration: underline;
        font-weight: 600;
        margin: 0 4px;
    }

    .site-announcement-strip__link:hover {
        color: var(--base_color, #fd4949);
        opacity: 0.85;
    }

    .site-announcement-strip__badge {
        display: inline-block;
        margin-right: 10px;
        padding: 2px 8px;
        border-radius: 3px;
        background: var(--base_color, #fd4949);
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    @keyframes siteAnnouncementScroll {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }

    @media (max-width: 767.98px) {
        .header__left.site-announcement-wrap {
            max-width: calc(100% - 100px);
        }

        .site-announcement-strip__item {
            font-size: 11px;
            height: 36px;
        }

        .site-announcement-strip__item + .site-announcement-strip__item {
            padding-left: 40px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .site-announcement-strip__track {
            animation: none;
            flex-wrap: wrap;
            width: 100%;
            justify-content: flex-start;
        }

        .site-announcement-strip__item + .site-announcement-strip__item {
            display: none;
        }
    }

    .left_sub_menu .site-announcement-strip {
        width: 100%;
    }
</style>
@endonce

<div class="site-announcement-strip" role="region" aria-label="{{ __('defaultTheme.site_announcement') }}">
    <div class="site-announcement-strip__viewport">
        <div class="site-announcement-strip__track">
            <span class="site-announcement-strip__item">
                <span class="site-announcement-strip__badge">{{ __('defaultTheme.new') }}</span>
                {!! $announcementMessage !!}
            </span>
            <span class="site-announcement-strip__item" aria-hidden="true">
                <span class="site-announcement-strip__badge">{{ __('defaultTheme.new') }}</span>
                {!! $announcementMessage !!}
            </span>
        </div>
    </div>
</div>
