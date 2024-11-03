# Contoh penggunaan buffering dalam I/O menggunakan Python

def buffered_read_write(input_file, output_file, buffer_size=1024):
    try:
        # Membuka file input untuk dibaca
        with open(input_file, 'r') as infile:
            # Membuka file output untuk ditulis
            with open(output_file, 'w') as outfile:
                buffer = ''
                while True:
                    # Membaca data dari file input
                    chunk = infile.read(buffer_size)
                    if not chunk:  # Jika tidak ada lagi data untuk dibaca
                        break
                    buffer += chunk  # Menambahkan chunk ke buffer
                    # Menulis buffer ke file output
                    outfile.write(buffer)
                    buffer = ''  # Mengosongkan buffer setelah menulis

        print(f'Data berhasil ditulis ke {output_file}')
    
    except Exception as e:
        print(f'Terjadi kesalahan: {e}')

# Panggil fungsi dengan file input dan output
buffered_read_write('input.txt', 'output.txt')
