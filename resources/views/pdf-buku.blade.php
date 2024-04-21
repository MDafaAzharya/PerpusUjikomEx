@extends('layouts.pdf-app')

@section('content')
    <div id="pdf-viewer"></div>
    @if ( auth()->user()->status !== 'member')
        <button id="member-button">Upgrade to Member</button>
    @endif
@endsection

@section('js-content')
<script src="{{asset('assets/vendor/pdf/pdf.min.js')}}"></script>
<script src="{{asset('assets/vendor/pdf/pdf.worker.js')}}"></script>
<script>
 var pdfUrl = "{{ asset('storage/buku/' . $buku->file_buku) }}";

// Mengambil referensi container
var pdfUrl = "{{ asset('storage/buku/' . $buku->file_buku) }}";

// Mengambil referensi container
var pdfViewer = document.getElementById('pdf-viewer');

// Mendapatkan status autentikasi dari PHP
var isMember = {!! json_encode(auth()->user()->status === 'member') !!};
// Memuat PDF menggunakan PDF.js
pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
    // Mendapatkan jumlah halaman PDF
    var pageCount = pdf.numPages;

    // Mengatur skala halaman
    var scale = 1.5;

    // Menentukan jumlah halaman yang akan ditampilkan berdasarkan status member
    var pagesToDisplay = isMember ? pageCount : Math.ceil(pageCount / 2);

    // Menggunakan loop untuk merender setiap halaman
    var pagePromises = [];

// Menggunakan loop untuk membuat promise merender setiap halaman
for (var pageNum = 1; pageNum <= pagesToDisplay; pageNum++) {
    // Menambahkan promise merender halaman ke dalam array
    pagePromises.push(pdf.getPage(pageNum).then(function(page) {
        var viewport = page.getViewport({
            scale: scale
        });
        var canvas = document.createElement('canvas');
        var context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;

        var renderContext = {
            canvasContext: context,
            viewport: viewport
        };

        // Memuat dan merender halaman
        return page.render(renderContext).promise.then(function() {
            // Mengembalikan canvas yang dirender
            return canvas;
        });
    }));
}

// Menunggu semua promise selesai dieksekusi
Promise.all(pagePromises).then(function(renderedPages) {
    // Menambahkan halaman-halaman ke dalam kontainer dalam urutan yang benar
    renderedPages.forEach(function(canvas) {
        pdfViewer.appendChild(canvas);
    });
});
});
</script>
@endsection