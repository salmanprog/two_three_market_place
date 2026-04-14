@extends('backEnd.master')
@section('styles')
<link rel="stylesheet" href="{{ asset(asset_path('modules/customer/css/style.css')) }}" />
<style>
    .admin-chat-shell {
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        min-height: calc(100vh - 220px);
        border: 1px solid var(--border_color, #e1e5eb);
        border-radius: 8px;
        overflow: hidden;
        background: var(--bg_white, #fff);
    }
    .admin-chat-sidebar {
        width: 100%;
        max-width: 320px;
        border-inline-end: 1px solid var(--border_color, #e1e5eb);
        display: flex;
        flex-direction: column;
        background: var(--input__bg, #f5f7fb);
    }
    @media (max-width: 991px) {
        .admin-chat-sidebar { max-width: 100%; border-inline-end: none; border-bottom: 1px solid var(--border_color, #e1e5eb); }
    }
    .admin-chat-sidebar-head {
        padding: 16px;
        border-bottom: 1px solid var(--border_color, #e1e5eb);
        background: var(--bg_white, #fff);
    }
    .admin-chat-sidebar-head h4 {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--text-color, #415094);
    }
    .admin-chat-thread-list {
        flex: 1;
        overflow-y: auto;
        max-height: calc(100vh - 320px);
    }
    .admin-chat-thread {
        width: 100%;
        text-align: start;
        border: 0;
        border-bottom: 1px solid var(--border_color, #eef0f4);
        padding: 12px 16px;
        background: transparent;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .admin-chat-thread:hover { background: rgba(65, 80, 148, 0.06); }
    .admin-chat-thread.is-active {
        background: linear-gradient(90deg, var(--gradient_1, #7c32ff) 0%, var(--gradient_2, #c738d8) 100%);
        color: var(--text_white, #fff);
    }
    .admin-chat-thread.is-active .admin-chat-thread-preview { color: rgba(255,255,255,0.85); }
    .admin-chat-thread-name { font-weight: 600; font-size: 14px; margin-bottom: 4px; }
    .admin-chat-thread-preview { font-size: 12px; color: var(--text-color, #676b84); line-height: 1.35; }
    .admin-chat-thread-meta { font-size: 11px; opacity: 0.75; margin-top: 4px; }
    .admin-chat-main {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        background: var(--bg_white, #fff);
    }
    .admin-chat-main-head {
        padding: 14px 20px;
        border-bottom: 1px solid var(--border_color, #e1e5eb);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .admin-chat-main-head h3 {
        margin: 0;
        font-size: 17px;
        font-weight: 600;
        color: var(--text-color, #415094);
    }
    .admin-chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        background: linear-gradient(180deg, var(--input__bg, #f8f9fc) 0%, var(--bg_white, #fff) 40%);
        min-height: 360px;
    }
    .admin-chat-day {
        text-align: center;
        font-size: 11px;
        color: var(--text-color, #828bb2);
        margin: 16px 0;
    }
    .admin-chat-row {
        display: flex;
        margin-bottom: 12px;
    }
    .admin-chat-row.own { justify-content: flex-end; }
    .admin-chat-bubble {
        max-width: 78%;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.45;
        word-break: break-word;
        box-shadow: 0 1px 2px rgba(41, 48, 66, 0.06);
    }
    .admin-chat-row:not(.own) .admin-chat-bubble {
        background: var(--bg_white, #fff);
        border: 1px solid var(--border_color, #e8ebf0);
        border-bottom-left-radius: 4px;
        color: var(--text-color, #415094);
    }
    .admin-chat-row.own .admin-chat-bubble {
        background: linear-gradient(135deg, var(--gradient_1, #7c32ff), var(--gradient_2, #c738d8));
        color: var(--text_white, #fff);
        border-bottom-right-radius: 4px;
    }
    .admin-chat-meta-line {
        font-size: 11px;
        margin-top: 6px;
        opacity: 0.85;
    }
    .admin-chat-row.own .admin-chat-meta-line { text-align: right; color: rgba(255,255,255,0.9); }
    .admin-chat-row:not(.own) .admin-chat-meta-line { color: var(--text-color, #828bb2); }
    .admin-chat-composer {
        border-top: 1px solid var(--border_color, #e1e5eb);
        padding: 14px 16px;
        background: var(--bg_white, #fff);
    }
    .admin-chat-composer-inner {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }
    .admin-chat-composer textarea {
        flex: 1;
        min-height: 44px;
        max-height: 140px;
        resize: vertical;
        border-radius: 8px;
        border: 1px solid var(--border_color, #e1e5eb);
        padding: 10px 12px;
        background: var(--input__bg, #f5f7fb);
        color: var(--text-color, #415094);
    }
    .admin-chat-empty {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: var(--text-color, #828bb2);
        padding: 40px 20px;
        text-align: center;
    }
    .admin-chat-empty i { font-size: 42px; margin-bottom: 12px; opacity: 0.35; }
</style>
@endsection
@section('mainContent')
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="box_header common_table_header mb_20">
                    <div class="main-title d-md-flex align-items-center">
                        <h3 class="mb-0 mr-30">{{ __('Chat Messages') }}</h3>
                    </div>
                </div>
                <div class="admin-chat-shell white_box_30px mb_30 p-0">
                    <aside class="admin-chat-sidebar">
                        <div class="admin-chat-sidebar-head">
                            <h4>{{ __('New conversation') }}</h4>
                            <select id="admin-chat-new-user" class="primary_input_field w-100 mb-2">
                                <option value="">{{ __('common.select_one') }}</option>
                                @foreach($usersForNew as $u)
                                    @php
                                        $label = trim(($u->first_name ?? '').' '.($u->last_name ?? '')) ?: $u->email;
                                    @endphp
                                    <option value="{{ $u->id }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="primary-btn fix-gr-bg w-100 radius_4px" id="admin-chat-btn-compose">
                                <i class="ti-pencil-alt mr-1"></i>{{ __('Compose') }}
                            </button>
                        </div>
                        <div class="admin-chat-thread-list" id="admin-chat-thread-list">
                            @forelse($conversations as $c)
                                <button type="button"
                                    class="admin-chat-thread"
                                    data-slug="{{ e($c['slug']) }}"
                                    data-name="{{ e($c['other_name']) }}">
                                    <div class="admin-chat-thread-name">{{ $c['other_name'] }}</div>
                                    <div class="admin-chat-thread-preview">{{ $c['preview'] }}</div>
                                    @if(!empty($c['updated_at']))
                                        <div class="admin-chat-thread-meta">{{ \Carbon\Carbon::parse($c['updated_at'])->diffForHumans() }}</div>
                                    @endif
                                </button>
                            @empty
                                <div class="p-3 text-center text-muted small" id="admin-chat-no-threads">{{ __('common.no_data_available_in_table') }}</div>
                            @endforelse
                        </div>
                    </aside>
                    <div class="admin-chat-main">
                        <div class="admin-chat-main-head">
                            <h3 id="admin-chat-title">{{ __('Select a conversation') }}</h3>
                        </div>
                        <div class="admin-chat-messages" id="admin-chat-messages">
                            <div class="admin-chat-empty" id="admin-chat-placeholder">
                                <i class="ti-comments"></i>
                                <p class="mb-0">{{ __('Choose someone from the list or start a new conversation.') }}</p>
                            </div>
                        </div>
                        <div class="admin-chat-composer d-none" id="admin-chat-composer">
                            <div class="admin-chat-composer-inner">
                                <textarea id="admin-chat-input" rows="2" placeholder="{{ __('common.type') }}…" class="primary_input_field"></textarea>
                                <button type="button" class="primary-btn fix-gr-bg semi_large2" id="admin-chat-send">
                                    <i class="ti-location-arrow"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
<script>
(function () {
    var fetchUrl = @json(route('chat.messages.fetch'));
    var sendUrl = @json(route('chat.messages.store'));
    var csrf = document.querySelector('meta[name="_token"]')?.getAttribute('content') || '';

    var state = { slug: null, isNew: false, pollTimer: null, pendingReceiverId: null };

    var elMessages = document.getElementById('admin-chat-messages');
    var elComposer = document.getElementById('admin-chat-composer');
    var elInput = document.getElementById('admin-chat-input');
    var elSend = document.getElementById('admin-chat-send');
    var elTitle = document.getElementById('admin-chat-title');
    var elNewUser = document.getElementById('admin-chat-new-user');
    var elThreadList = document.getElementById('admin-chat-thread-list');

    function escapeHtml(s) {
        if (!s) return '';
        var d = document.createElement('div');
        d.textContent = s;
        return d.innerHTML;
    }

    function clearPoll() {
        if (state.pollTimer) {
            clearInterval(state.pollTimer);
            state.pollTimer = null;
        }
    }

    function setActiveThread(btn) {
        document.querySelectorAll('.admin-chat-thread').forEach(function (b) { b.classList.remove('is-active'); });
        if (btn) btn.classList.add('is-active');
    }

    function renderMessages(items) {
        var html = '';
        items.forEach(function (m) {
            var rowClass = m.is_own ? 'admin-chat-row own' : 'admin-chat-row';
            var when = m.created_at ? new Date(m.created_at).toLocaleString() : '';
            html += '<div class="' + rowClass + '">' +
                '<div class="admin-chat-bubble">' + escapeHtml(m.message || '') +
                '<div class="admin-chat-meta-line">' + escapeHtml(m.sender_label || '') + ' · ' + escapeHtml(when) + '</div>' +
                '</div></div>';
        });
        elMessages.innerHTML = html || '<div class="admin-chat-empty"><p class="mb-0">' + @json(__('common.no_data_available_in_table')) + '</p></div>';
        elMessages.scrollTop = elMessages.scrollHeight;
    }

    function loadMessages() {
        if (!state.slug) return;
        var url = fetchUrl + (fetchUrl.indexOf('?') >= 0 ? '&' : '?') + 'slug=' + encodeURIComponent(state.slug);
        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(function (r) {
                if (!r.ok) return { messages: [] };
                return r.json();
            })
            .then(function (data) {
                if (data && data.messages) renderMessages(data.messages);
            })
            .catch(function () {});
    }

    function startPolling() {
        clearPoll();
        state.pollTimer = setInterval(loadMessages, 8000);
    }

    function openThread(slug, title, isNew) {
        state.slug = slug;
        state.isNew = !!isNew;
        if (!state.isNew) {
            state.pendingReceiverId = null;
        }
        clearPoll();
        elComposer.classList.remove('d-none');
        document.getElementById('admin-chat-placeholder')?.remove();
        elTitle.textContent = title || @json(__('Chat Messages'));

        if (state.slug && !state.isNew) {
            loadMessages();
            startPolling();
        } else {
            elMessages.innerHTML = '<div class="admin-chat-empty"><p class="mb-0">' + @json(__('Type your first message below.')) + '</p></div>';
        }
    }

    document.querySelectorAll('.admin-chat-thread').forEach(function (btn) {
        btn.addEventListener('click', function () {
            setActiveThread(btn);
            openThread(btn.getAttribute('data-slug'), btn.getAttribute('data-name'), false);
        });
    });

    document.getElementById('admin-chat-btn-compose').addEventListener('click', function () {
        var uid = elNewUser.value;
        if (!uid) {
            if (typeof toastr !== 'undefined') toastr.warning(@json(__('common.select_one')));
            return;
        }
        setActiveThread(null);
        var opt = elNewUser.options[elNewUser.selectedIndex];
        openThread(null, opt.text, true);
        state.pendingReceiverId = uid;
    });

    function prependThreadButton(slug, name, preview) {
        var nt = document.getElementById('admin-chat-no-threads');
        if (nt && nt.parentNode) nt.parentNode.removeChild(nt);
        var b = document.createElement('button');
        b.type = 'button';
        b.className = 'admin-chat-thread is-active';
        b.setAttribute('data-slug', slug);
        b.setAttribute('data-name', name);
        b.innerHTML = '<div class="admin-chat-thread-name"></div><div class="admin-chat-thread-preview"></div><div class="admin-chat-thread-meta"></div>';
        b.querySelector('.admin-chat-thread-name').textContent = name;
        b.querySelector('.admin-chat-thread-preview').textContent = preview || '';
        b.querySelector('.admin-chat-thread-meta').textContent = '';
        b.addEventListener('click', function () {
            setActiveThread(b);
            openThread(slug, name, false);
        });
        elThreadList.insertBefore(b, elThreadList.firstChild);
        document.querySelectorAll('.admin-chat-thread').forEach(function (x) { if (x !== b) x.classList.remove('is-active'); });
    }

    elSend.addEventListener('click', function () {
        var text = (elInput.value || '').trim();
        if (!text) return;

        var body = { _token: csrf, message: text };
        if (state.isNew || !state.slug) {
            var rid = state.pendingReceiverId || elNewUser.value;
            if (!rid) {
                if (typeof toastr !== 'undefined') toastr.warning(@json(__('common.select_one')));
                return;
            }
            body.receiver_id = parseInt(rid, 10);
            body.slug = '';
        } else {
            body.slug = state.slug;
        }

        fetch(sendUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(body)
        })
        .then(function (r) { return r.json().then(function (j) { return { ok: r.ok, j: j }; }); })
        .then(function (res) {
            if (!res.ok) {
                var err = res.j.errors || {};
                var msg = (err.message && err.message[0]) || (err.receiver_id && err.receiver_id[0]) || (err.slug && err.slug[0]) || res.j.message || @json(__('common.error_message'));
                if (typeof toastr !== 'undefined') toastr.error(msg);
                return;
            }
            elInput.value = '';
            var slug = res.j.slug;
            var chat = res.j.chat;
            if (state.isNew && slug) {
                var title = elTitle.textContent;
                prependThreadButton(slug, title, chat.message);
                state.isNew = false;
                state.slug = slug;
                state.pendingReceiverId = null;
                loadMessages();
                startPolling();
            } else {
                loadMessages();
            }
        })
        .catch(function () {
            if (typeof toastr !== 'undefined') toastr.error(@json(__('common.error_message')));
        });
    });

    elInput.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            elSend.click();
        }
    });
})();
</script>
@endpush
