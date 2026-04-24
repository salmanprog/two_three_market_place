<style>
    .seller-product-address-wrap.position-relative { position: relative; }
    .seller-address-suggestions {
        position: absolute;
        left: 0;
        right: 0;
        top: 100%;
        z-index: 1050;
        max-height: 240px;
        overflow-y: auto;
        background: var(--bg_white, #fff);
        border: 1px solid var(--border_color, #e2e6ef);
        border-radius: 4px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
        list-style: none;
        margin: 2px 0 0;
        padding: 0;
    }
    .seller-address-suggestions li {
        padding: 10px 14px;
        cursor: pointer;
        font-size: 13px;
        line-height: 1.35;
        border-bottom: 1px solid var(--border_color, #eef0f7);
    }
    .seller-address-suggestions li:last-child { border-bottom: 0; }
    .seller-address-suggestions li:hover { background: var(--input__bg, #f5f7fb); }
    .pac-container { z-index: 10050 !important; }
</style>
