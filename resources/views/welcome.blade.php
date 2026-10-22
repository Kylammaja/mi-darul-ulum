
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>MI Darul Ullum Gedongan</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
<link
    href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&display=swap"
    rel="stylesheet"
>


    <link rel="preconnect"
          href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-background font-body">

    <!-- NAVBAR -->
    @include('partials.navbar')

    <!-- MAIN CONTENT -->
    <main>
    @include('sections.hero')   

    @include('sections.visi-misi')

    @include('sections.sambutan-kepala')

    {{-- BERITA & PRESTASI --}}
       @include('sections.components.news-section')
</main>

{{-- FOOTER --}}
    @include('partials.footer')

</body>
</html>
