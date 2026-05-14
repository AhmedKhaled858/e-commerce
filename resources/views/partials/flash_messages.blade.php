  <div class="heading_container heading_center mb-5 position-relative">
      @if (session('success'))
          <script>
              window.flashSuccess = @json(session('success'));
          </script>
      @endif

      @if (session('error'))
          <script>
              window.flashError = @json(session('error'));
          </script>
      @endif
  </div>
