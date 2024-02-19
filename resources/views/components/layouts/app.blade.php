<!DOCTYPE html>
<html lang="en">

<x-layouts.partials.header />

<style>
    .footer {
        margin-top: 10%;
    }

    /* Media query para pantallas grandes (mayor a 1200px) */
    /* @media (min-width: 1200px) {
        .footer {
            margin-top: %; */
    /* 20% de margen superior en pantallas grandes */
    /* }
    } */

    /* Media query para pantallas medianas (entre 992px y 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .footer {
            margin-top: 50%;
            /* 20% de margen superior en pantallas medianas */
        }
    }

    /* Media query para pantallas pequeñas (menor a 992px) */
    @media (max-width: 991px) {
        .footer {
            margin-top: 60%;
            /* 20% de margen superior en pantallas pequeñas */
        }
    }
</style>


<body>

    <x-layouts.partials.navbar />

    <x-layouts.partials.sidebar />

    <main id="main" class="main">

        <section class="section dashboard">
            {{ $slot }}
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    {{-- <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>BryanProtto</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bryanprotto.com/">BryanProtto</a>
        </div>
    </footer> --}}
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


    <x-layouts.partials.footer />

</body>

</html>
