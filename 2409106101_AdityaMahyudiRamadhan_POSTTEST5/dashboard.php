<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$message = '';
if (isset($_GET['message'])) {
    $message = htmlspecialchars($_GET['message']);
}

$username = $_SESSION['username'];

// CREATE
if (isset($_POST['tambah'])) {
    $id = $_POST['ID'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    mysqli_query($koneksi, "INSERT INTO pegawai (ID, nama, jabatan) VALUES ('$id','$nama','$jabatan')");
    header("Location: dashboard.php?message=Data berhasil ditambahkan");
    exit();
}

// UPDATE
if (isset($_POST['update'])) {
    $id = $_POST['ID'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    mysqli_query($koneksi, "UPDATE pegawai SET nama='$nama', jabatan='$jabatan' WHERE ID='$id'");
    header("Location: dashboard.php?message=Data berhasil diubah");
    exit();
}

// DELETE
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pegawai WHERE ID='$id'");
    header("Location: dashboard.php?message=Data berhasil dihapus");
    exit();
}

// READ
$data_pegawai = mysqli_query($koneksi, "SELECT * FROM pegawai");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard PT. Ebos Group</title>

    <link rel="stylesheet" href="2409106101_AdityaMahyudiRamadhan_POSTTEST5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <header>
        <h1>Dashboard PT. Ebos Group</h1>
        <p>Selamat datang, <strong><?php echo $username; ?></strong>! | <a href="logout.php">Logout</a></p>
        <?php if (!empty($message)): ?>
            <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
        <?php endif; ?>
        <button id="themeToggle" class="theme-toggle-btn">
            <span class="theme-icon"><i class="fas fa-moon"></i></span>
            <span class="theme-text">Dark Mode</span>
        </button>
    </header>

    <main>
        <section id="tentang-kami">
            <h2>Tentang Kami</h2>
            <article>
                <p>PT. Ebos Group adalah perusahaan terkemuka di bidang konstruksi dan infrastruktur, berdedikasi untuk menciptakan solusi inovatif dan berkelanjutan.</p>
                <p>Kami memiliki visi untuk menjadi pemimpin dalam industri ini, membangun karya-karya yang berkontribusi pada kemajuan bangsa.</p>
            </article>
        </section>
    </main>

    <main>
        <div class="form-container">
            <h2>Tambah / Edit Data Pegawai</h2>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="ID">ID:</label>
                    <input type="text" id="ID" name="ID" placeholder="Masukkan Nomor ID Pegawai" required>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Pegawai" required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <input type="text" id="jabatan" name="jabatan" placeholder="Contoh: Manajer" required>
                </div>

                <button type="submit" name="tambah">Simpan Data</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Daftar Pegawai</h2>
            <table id="pegawaiTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($data_pegawai)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['ID']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['jabatan']) ?></td>
                            <td>
                                <a href="?edit=<?= $row['ID'] ?>" class="btn-edit">Edit</a>
                                <a href="?hapus=<?= $row['ID'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn-delete">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php
        // Jika sedang mengedit data
        if (isset($_GET['edit'])) {
            $id_edit = $_GET['edit'];
            $edit_query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE ID='$id_edit'");
            $data_edit = mysqli_fetch_assoc($edit_query);
        ?>
        <div class="form-container">
            <h2>Edit Data Pegawai</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="ID">ID:</label>
                    <input type="text" id="ID" name="ID" value="<?= $data_edit['ID'] ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nama">Nama Lengkap:</label>
                    <input type="text" id="nama" name="nama" value="<?= $data_edit['nama'] ?>" required>
                </div>

                <div class="form-group">
                    <label for="jabatan">Jabatan:</label>
                    <input type="text" id="jabatan" name="jabatan" value="<?= $data_edit['jabatan'] ?>" required>
                </div>

                <button type="submit" name="update">Update Data</button>
            </form>
        </div>
        <?php } ?>
    </main>

    <footer>
        <p>Hak Cipta &copy; 2025 PT. Ebos Group. Semua Hak Dilindungi.</p>
    </footer>

    <script src="2409106101_AdityaMahyudiRamadhan_POSTTEST5.js" defer></script>
</body>
</html>
