@if (isset($error) && $error)
  <div class="error-block hide">{{ $error }}</div>
@endif
@if (isset($message) && $message)
  <div class="message-block hide">{{ $message }}</div>
@endif
@if (isset($jsApp))
  <div class="app-trigger" id="_{{ $jsApp['title'] }}" rel='{{ json_encode($jsApp['data']) }}'></div>
@endif
  <script src="/assets/js/lib-body"></script>