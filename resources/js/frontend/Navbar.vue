<template>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
            <div class="container">
                <div class="d-flex d-lg-none align-items-center justify-content-between w-100">
                    <Link class="navbar-brand d-inline d-lg-none" href="/">
                        <img src="frontend/images/logo.jpg" class="" width="100" alt="logo">
                    </Link>
                    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11"
                            aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                    <a class="navbar-brand col-lg-2 me-0 mt-2 mt-lg-0 d-none d-lg-block" href="/">
                        <img src="frontend/images/logo.jpg" class="w-100 h-auto" alt="" />
                    </a>
                    <ul class="navbar-nav col-lg-5 justify-content-lg-center">
                        <li class="nav-item">
                            <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                        </li>
                        <li class="nav-item">
                            <Link class="nav-link" href="/about">About</Link>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">SEO</a></li>
                                <li><a class="dropdown-item" href="#">Sports</a></li>
                                <li><a class="dropdown-item" href="#">AI</a></li>
                                <li><a class="dropdown-item" href="#">OTT</a></li>
                                <li><a class="dropdown-item" href="#">Combo Offers</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"  data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a>
                        </li>
                    </ul>



                    <div class="d-lg-flex col-lg-5 justify-content-lg-end align-items-center gap-2 mt-1 mt-lg-0">
                        <form role="search" class="form-width">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" >
                        </form>
                        <a class="btn btn-outline-success mt-2 mt-lg-0 me-2 me-lg-0" >Affiliate</a>

                        <a class="btn btn-success mt-2 mt-lg-0">Live Chat</a>
                        <div  class="d-inline mt-2 mt-lg-0">
                            <select class="currency-selector shadow-none rounded border-success">
                                <option data-symbol="$" data-placeholder="0.00" selected>USD</option>
                                <option data-symbol="€" data-placeholder="0.00">EUR</option>
                                <option data-symbol="£" data-placeholder="0.00">INR</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
export default {
    name: "Navbar",
}
</script>
<style scoped>

</style>
