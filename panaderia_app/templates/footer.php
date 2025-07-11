</div>

<footer class="bg-dark text-white text-center p-3">
    <p>© 2023 Panadería "El Buen Sabor"</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alerta = document.getElementById('alerta-estado');

        if (alerta) {
            
            const url = new URL(window.location);
            url.searchParams.delete('status');
            window.history.replaceState({}, document.title, url);

            setTimeout(function() {
                const alertaVisible = document.getElementById('alerta-estado');
                if (alertaVisible) {
                    const bsAlert = new bootstrap.Alert(alertaVisible);
                    bsAlert.close();
                }
            }, 3000);
        }
    });
</script>

</body>
</html>