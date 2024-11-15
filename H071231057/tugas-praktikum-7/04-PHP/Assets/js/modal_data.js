    // Open Add Data Modal
    document.getElementById('addDataBtn').addEventListener('click', function() {
        document.getElementById('mahasiswaModal').classList.remove('hidden');
    });

    // Close Modal
    document.getElementById('closeModal').addEventListener('click', function() {
        document.getElementById('mahasiswaModal').classList.add('hidden');
    });