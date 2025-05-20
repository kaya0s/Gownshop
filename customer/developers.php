<?php include('../includes/customer/header.php'); ?>

<style>
body {
    background: #18181c !important;
    color: #fff;
    font-family: 'Raleway', sans-serif;
}
.devs-section {
    background: #18181c;
    min-height: 100vh;
    padding: 40px 0;
}
.dev-card {
    background: rgba(36, 37, 42, 0.7);
    border-radius: 15px;
    box-shadow: 0 8px 32px 0 rgba(0,0,0,0.37);
    padding: 40px 28px 32px 28px;
    margin: 24px 0;
    transition: transform 0.2s, box-shadow 0.2s;
    position: relative;
    backdrop-filter: blur(8px);
    border: 1.5px solid rgba(255,255,255,0.08);
}
.dev-card:hover {
    transform: translateY(-10px) scale(1.04);
    box-shadow: 0 16px 40px 0 rgba(0,0,0,0.45);
    border: 1.5px solid rgba(255,255,255,0.18);
}
.dev-img-container {
    background: #fff;
    border-radius: 24px;
    width: 150px;
    height: 150px;
    margin: 0 auto 22px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    box-shadow: 0 4px 24px rgba(0,0,0,0.13);
    border: 4px solid #232323;
}
.dev-img-container img {
    width: 140px;
    height: 140px;
    object-fit: cover;
    border-radius: 18px;
}
.dev-name {
    font-weight: 800;
    font-size: 1.25rem;
    margin-bottom: 8px;
    letter-spacing: 1.2px;
    text-transform: uppercase;
}
.dev-role {
    color: #bdbdbd;
    font-size: 1.05rem;
    margin-bottom: 22px;
    letter-spacing: 0.7px;
}
.dev-socials {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 22px;
}
.dev-socials a {
    background: rgba(36, 37, 42, 0.9);
    color: #fff;
    border-radius: 12px;
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 12px rgba(0,0,0,0.13);
    text-decoration: none;
    border: 1.5px solid rgba(255,255,255,0.08);
}
.dev-socials a:hover {
    background: #fff;
    color: #232323;
    box-shadow: 0 4px 16px rgba(0,0,0,0.18);
    border: 1.5px solid #232323;
}
</style>

<div class="devs-section">
    <div class="container py-5">
        <h2 class="text-center mb-4" style="font-weight:800; letter-spacing:1.5px; color:#fff;">Meet the Developers</h2>
        <div class="row justify-content-center">
            <!-- Backend Developer -->
            <div class="col-md-4 mb-4">
                <div class="dev-card text-center">
                    <div class="dev-img-container">
                        <img src="../assets/images/gar.jpg" alt="Erwin Lanzaderas">
                    </div>
                    <div class="dev-name">JAYSON GARIO</div>
                    <div class="dev-role">PROJECT MANAGER</div>
                    <div class="dev-socials">
                        <a href="https://github.com/erwinlanzaderas" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://instagram.com/erwinlanzaderas" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <!-- Project Manager -->
            <div class="col-md-4 mb-4">
                <div class="dev-card text-center">
                    <div class="dev-img-container">
                        <img src="../assets/images/yaos.jpg" alt="Jayson Gario">
                    </div>
                    <div class="dev-name">ERWIN LANZADERAS</div>
                    <div class="dev-role">WEB DEVELOPER</div>
                    <div class="dev-socials">
                        <a href="https://github.com/kaya0s" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://instagram.com/yaosthegreat" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <!-- Frontend Developer -->
            <div class="col-md-4 mb-4">
                <div class="dev-card text-center">
                    <div class="dev-img-container">
                        <img src="../assets/images/jus.jpg" alt="Josua Cagampang">
                    </div>
                    <div class="dev-name">JOSUA CAGAMPANG</div>
                    <div class="dev-role">DESIGNER</div>
                    <div class="dev-socials">
                        <a href="https://github.com/josuacagampang" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
                        <a href="https://instagram.com/josuacagampang" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col text-center">
                <a style="background-color:white; color: black; border: 1px solid white; border-radius: 0px; padding: 12px 24px;" href="homepage.php" class="btn btn-outline-primary">Back to Home</a>
            </div>
        </div>
    </div>
</div>

<?php include('../includes/customer/footer.php'); ?> 