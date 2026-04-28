<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="space-y-6">

        <!-- Title -->
        <div>
            <label class="block font-semibold">Judul</label>
            <input type="text" name="title" class="w-full border rounded-lg p-3">
        </div>

        <!-- Category -->
        <div>
            <label class="block font-semibold">Kategori</label>
            <input type="text" name="category" class="w-full border rounded-lg p-3">
        </div>

        <!-- Thumbnail -->
        <div>
            <label class="block font-semibold">Thumbnail</label>
            <input type="file" name="thumbnail">
        </div>

        <!-- Excerpt -->
        <div>
            <label class="block font-semibold">Ringkasan</label>
            <textarea name="excerpt" class="w-full border rounded-lg p-3"></textarea>
        </div>

        <!-- Content (RICH TEXT) -->
        <div>
            <label class="block font-semibold">Isi Artikel</label>
            <textarea id="editor" name="content"></textarea>
        </div>

        <!-- Publish -->
        <div>
            <label class="block font-semibold">Tanggal Publish</label>
            <input type="date" name="published_at">
        </div>

        <button class="bg-teal-600 text-white px-6 py-3 rounded-lg">
            Simpan
        </button>
    </div>
</form>
</body>
</html>