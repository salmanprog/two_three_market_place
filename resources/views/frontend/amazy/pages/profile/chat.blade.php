@extends('frontend.amazy.layouts.app')
@push('styles')
<style>
    .fp-chat-shell {
        display: flex;
        flex-wrap: wrap;
        gap: 0;
        min-height: 520px;
        border: 1px solid #eceef3;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
    }
    .fp-chat-sidebar {
        width: 100%;
        max-width: 300px;
        border-inline-end: 1px solid #eceef3;
        display: flex;
        flex-direction: column;
        background: #f8f9fc;
    }
    @media (max-width: 991px) {
        .fp-chat-sidebar { max-width: 100%; border-inline-end: none; border-bottom: 1px solid #eceef3; }
    }
    .fp-chat-sidebar-head {
        padding: 16px;
        border-bottom: 1px solid #eceef3;
        background: #fff;
    }
    .fp-chat-sidebar-head h4 {
        font-size: 15px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #00124e;
    }
    .fp-chat-thread-list {
        flex: 1;
        overflow-y: auto;
        max-height: 420px;
    }
    .fp-chat-thread {
        width: 100%;
        text-align: start;
        border: 0;
        border-bottom: 1px solid #eef0f4;
        padding: 12px 14px;
        background: transparent;
        cursor: pointer;
        transition: background 0.15s ease;
    }
    .fp-chat-thread:hover { background: rgba(253, 73, 73, 0.06); }
    .fp-chat-thread.is-active {
        background: linear-gradient(90deg, #fd4949 0%, #ff7a7a 100%);
        color: #fff;
    }
    .fp-chat-thread.is-active .fp-chat-thread-preview { color: rgba(255,255,255,0.9); }
    .fp-chat-thread-name { font-weight: 600; font-size: 14px; margin-bottom: 4px; color: inherit; }
    .fp-chat-thread-preview { font-size: 12px; color: #676b84; line-height: 1.35; }
    .fp-chat-thread.is-active .fp-chat-thread-name { color: #fff; }
    .fp-chat-thread-meta { font-size: 11px; opacity: 0.8; margin-top: 4px; }
    .fp-chat-main {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
        background: #fff;
    }
    .fp-chat-main-head {
        padding: 14px 18px;
        border-bottom: 1px solid #eceef3;
    }
    .fp-chat-main-head h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #00124e;
    }
    .fp-chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 18px;
        background: linear-gradient(180deg, #fafbfe 0%, #fff 45%);
        min-height: 320px;
    }
    .fp-chat-row { display: flex; margin-bottom: 12px; }
    .fp-chat-row.own { justify-content: flex-end; }
    .fp-chat-bubble {
        max-width: 80%;
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 14px;
        line-height: 1.45;
        word-break: break-word;
        box-shadow: 0 1px 3px rgba(0,18,78,0.06);
    }
    .fp-chat-row:not(.own) .fp-chat-bubble {
        background: #fff;
        border: 1px solid #eceef3;
        border-bottom-left-radius: 4px;
        color: #00124e;
    }
    .fp-chat-row.own .fp-chat-bubble {
        background: linear-gradient(135deg, #fd4949, #ff6b6b);
        color: #fff;
        border-bottom-right-radius: 4px;
    }
    .fp-chat-meta-line {
        font-size: 11px;
        margin-top: 6px;
        opacity: 0.9;
    }
    .fp-chat-row:not(.own) .fp-chat-meta-line { color: #828bb2; }
    .fp-chat-row.own .fp-chat-meta-line { text-align: right; color: rgba(255,255,255,0.95); }
    .fp-chat-composer {
        border-top: 1px solid #eceef3;
        padding: 14px 16px;
        background: #fff;
    }
    .fp-chat-composer-inner { display: flex; gap: 10px; align-items: flex-end; }
    .fp-chat-composer textarea {
        flex: 1;
        min-height: 46px;
        max-height: 140px;
        resize: vertical;
        border-radius: 10px;
        border: 1px solid #eceef3;
        padding: 10px 12px;
        background: #f8f9fc;
        color: #00124e;
    }
    .fp-chat-empty {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: #828bb2;
        padding: 36px 16px;
        text-align: center;
    }
    .fp-chat-empty i { font-size: 40px; margin-bottom: 12px; opacity: 0.35; color: #fd4949; }
</style>
@endpush
@section('content')
<div class="amazy_dashboard_area dashboard_bg section_spacing6">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4">
                @include('frontend.amazy.pages.profile.partials._menu')
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="dashboard_white_box style2 bg-white mb_25">
                    <ul class="nav profile_tabs mb_25" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ request()->routeIs('frontend.dashboard') ? 'active' : '' }}" href="{{ route('frontend.dashboard') }}">{{ __('common.dashboard') }}</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link {{ request()->routeIs('frontend.profile.messages') ? 'active' : '' }}" href="{{ route('frontend.profile.messages') }}">{{ __('Chat Messages') }}</a>
                        </li>
                    </ul>
                    <div class="dashboard_white_box_header d-flex align-items-center justify-content-between flex-wrap gap-2 mb_20">
                        <h4 class="font_24 f_w_700 m-0">{{ __('Chat Messages') }}</h4>
                    </div>
                    <div class="dashboard_white_box_body p-0">
                        <div class="fp-chat-shell">
                            <aside class="fp-chat-sidebar">
                                <div class="fp-chat-sidebar-head">
                                    <h4>{{ __('Message support') }}</h4>
                                    <select id="fp-chat-new-user" class="amaz_select3 w-100 mb-2">
                                        <option value="">{{ __('common.select_one') }}</option>
                                        @foreach($usersForNew as $u)
                                            @php
                                                $label = trim(($u->first_name ?? '').' '.($u->last_name ?? '')) ?: $u->email;
                                            @endphp
                                            <option value="{{ $u->id }}">{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    @if($usersForNew->isEmpty())
                                        <p class="font_12 mute_text mb-2">{{ __('No team members are available to message yet.') }}</p>
                                    @endif
                                    <button type="button" class="amaz_primary_btn style2 w-100 text-center" id="fp-chat-btn-compose">
                                        {{ __('Compose') }}
                                    </button>
                                </div>
                                <div class="fp-chat-thread-list" id="fp-chat-thread-list">
                                    @forelse($conversations as $c)
                                        <button type="button"
                                            class="fp-chat-thread"
                                            data-slug="{{ e($c['slug']) }}"
                                            data-name="{{ e($c['other_name']) }}">
                                            <div class="fp-chat-thread-name">{{ $c['other_name'] }}</div>
                                            <div class="fp-chat-thread-preview">{{ $c['preview'] }}</div>
                                            @if(!empty($c['updated_at']))
                                                <div class="fp-chat-thread-meta">{{ \Carbon\Carbon::parse($c['updated_at'])->diffForHumans() }}</div>
                                            @endif
                                        </button>
                                    @empty
                                        <div class="p-3 text-center font_14 mute_text" id="fp-chat-no-threads">{{ __('common.no_data_available_in_table') }}</div>
                                    @endforelse
                                </div>
                            </aside>
                            <div class="fp-chat-main">
                                <div class="fp-chat-main-head">
                                    <h3 id="fp-chat-title">{{ __('Select a conversation') }}</h3>
                                </div>
                                <div class="fp-chat-messages" id="fp-chat-messages">
                                    <div class="fp-chat-empty" id="fp-chat-placeholder">
                                        <i class="ti-comments"></i>
                                        <p class="mb-0 font_14">{{ __('Open a thread from the list or compose a new message to the team.') }}</p>
                                    </div>
                                </div>
                                <div class="fp-chat-composer d-none" id="fp-chat-composer">
                                    <div class="fp-chat-composer-inner">
                                        <textarea id="fp-chat-input" rows="2" placeholder="{{ __('common.type') }}…" class="primary_input_field"></textarea>
                                        <button type="button" class="amaz_primary_btn style2" id="fp-chat-send" title="{{ __('common.send') }}">
                                            <i class="ti-location-arrow"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
(function () {
    var fetchUrl = @json(route('frontend.profile.messages.fetch'));
    var sendUrl = @json(route('frontend.profile.messages.store'));
    var csrf = document.querySelector('meta[name="_token"]')?.getAttribute('content') || '';
    var state = { slug: null, isNew: false, pollTimer: null, pendingReceiverId: null };

    var elMessages = document.getElementById('fp-chat-messages');
    var elComposer = document.getElementById('fp-chat-composer');
    var elInput = document.getElementById('fp-chat-input');
    var elSend = document.getElementById('fp-chat-send');
    var elTitle = document.getElementById('fp-chat-title');
    var elNewUser = document.getElementById('fp-chat-new-user');
    var elThreadList = document.getElementById('fp-chat-thread-list');

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
        document.querySelectorAll('.fp-chat-thread').forEach(function (b) { b.classList.remove('is-active'); });
        if (btn) btn.classList.add('is-active');
    }

    function renderMessages(items) {
        var html = '';
        items.forEach(function (m) {
            var rowClass = m.is_own ? 'fp-chat-row own' : 'fp-chat-row';
            var when = m.created_at ? new Date(m.created_at).toLocaleString() : '';
            html += '<div class="' + rowClass + '">' +
                '<div class="fp-chat-bubble">' + escapeHtml(m.message || '') +
                '<div class="fp-chat-meta-line">' + escapeHtml(m.sender_label || '') + ' · ' + escapeHtml(when) + '</div>' +
                '</div></div>';
        });
        elMessages.innerHTML = html || '<div class="fp-chat-empty"><p class="mb-0 font_14">' + @json(__('common.no_data_available_in_table')) + '</p></div>';
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
        document.getElementById('fp-chat-placeholder')?.remove();
        elTitle.textContent = title || @json(__('Chat Messages'));

        if (state.slug && !state.isNew) {
            loadMessages();
            startPolling();
        } else {
            elMessages.innerHTML = '<div class="fp-chat-empty"><p class="mb-0 font_14">' + @json(__('Type your first message below.')) + '</p></div>';
        }
    }

    document.querySelectorAll('.fp-chat-thread').forEach(function (btn) {
        btn.addEventListener('click', function () {
            setActiveThread(btn);
            openThread(btn.getAttribute('data-slug'), btn.getAttribute('data-name'), false);
        });
    });

    document.getElementById('fp-chat-btn-compose').addEventListener('click', function () {
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
        var nt = document.getElementById('fp-chat-no-threads');
        if (nt && nt.parentNode) nt.parentNode.removeChild(nt);
        var b = document.createElement('button');
        b.type = 'button';
        b.className = 'fp-chat-thread is-active';
        b.setAttribute('data-slug', slug);
        b.setAttribute('data-name', name);
        b.innerHTML = '<div class="fp-chat-thread-name"></div><div class="fp-chat-thread-preview"></div><div class="fp-chat-thread-meta"></div>';
        b.querySelector('.fp-chat-thread-name').textContent = name;
        b.querySelector('.fp-chat-thread-preview').textContent = preview || '';
        b.querySelector('.fp-chat-thread-meta').textContent = '';
        b.addEventListener('click', function () {
            setActiveThread(b);
            openThread(slug, name, false);
        });
        elThreadList.insertBefore(b, elThreadList.firstChild);
        document.querySelectorAll('.fp-chat-thread').forEach(function (x) { if (x !== b) x.classList.remove('is-active'); });
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
