<?php
$db = new Database();
$form = new Form("", "Simpan");

if ($_POST) {
    $data = [
        'judul' => $_POST['judul'],
        'isi' => $_POST['isi']
    ];
    if ($db->insert('artikel', $data)) {
        echo "<div style='color:green'>Artikel berhasil ditambahkan!</div>";
    } else {
        echo "<div style='color:red'>Gagal menyimpan artikel.</div>";
    }
}
?>

<h3>Tambah Artikel</h3>
<?php
$form->addField("judul", "Judul");
$form->addField("isi", "Isi", "textarea");
$form->displayForm();
?>