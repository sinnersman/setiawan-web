@if (session('toast'))
    <div id="toast" class="show">{{ session('toast') }}</div>
    <script>
        setTimeout(function () {
            var t = document.getElementById('toast');
            if (t) t.classList.remove('show');
        }, 5000);
    </script>
@endif
