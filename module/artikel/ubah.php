<?php
// Include library Form
include_once "class/Form.php";

// Inisialisasi Database
$db = new Database();

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data artikel berdasarkan ID
$artikel = $db->get('artikel', "id = $id");

// Jika artikel tidak ditemukan
if (!$artikel) {
    echo '<div class="alert alert-danger">Artikel tidak ditemukan!</div>';
    return;
}

// Proses form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'judul' => $_POST['judul'],
        'konten' => $_POST['konten'],
        'kategori' => $_POST['kategori'],
        'penulis' => $_POST['penulis'],
        'status' => $_POST['status']
    ];
    
    $result = $db->update('artikel', $data, "id = $id");
    
    if ($result) {
        header('Location: ' . BASE_URL . 'artikel?success=diperbarui');
        exit;
    } else {
        $error = "Gagal memperbarui artikel!";
    }
}

$pageTitle = "Edit Artikel";
?>

<div class="content-header">
    <h2>Edit Artikel: <?php echo htmlspecialchars($artikel['judul']); ?></h2>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>

<?php
// Buat form menggunakan class Form
$form = new Form("", "Update Artikel");
$form->addField("judul", "Judul Artikel", "text", [], $artikel['judul']);
$form->addField("penulis", "Penulis", "text", [], $artikel['penulis']);
$form->addField("konten", "Konten", "textarea", [], $artikel['konten']);
$form->addField("kategori", "Kategori", "select", [
    'teknologi' => 'Teknologi',
    'pendidikan' => 'Pendidikan',
    'kesehatan' => 'Kesehatan',
    'olahraga' => 'Olahraga',
    'hiburan' => 'Hiburan'
], $artikel['kategori']);
$form->addField("status", "Status", "radio", [
    'draft' => 'Draft',
    'publish' => 'Publish'
], $artikel['status']);

$form->displayForm();
?>