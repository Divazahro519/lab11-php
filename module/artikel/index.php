<?php
$db = new Database();
$artikel = $db->query("SELECT * FROM artikel");
?>

<h3>Daftar Artikel</h3>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>Isi</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $artikel->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['judul']; ?></td>
            <td><?php echo substr($row['isi'], 0, 50) . '...'; ?></td>
            <td>
                <a href="<?php echo BASE_URL; ?>/artikel/ubah/<?php echo $row['id']; ?>">Ubah</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
<a href="<?php echo BASE_URL; ?>/artikel/tambah">Tambah Artikel</a>