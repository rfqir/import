<?php
$sku = isset($_GET['sku']) ? $_GET['sku'] : '';
// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong
$sku_condition = '';
if (!empty($sku)) {

    $sku_condition = "AND sku_toko LIKE'%$sku%'";
}
?>
<div id="tableContainer">
    <div class="col-xl-50">
        <div class="row">
            <div class="col-xl-50  mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-2">
                        <div class="text-center">Hi User Toko ♥</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="dataContainer">
            <?php
            $select = mysqli_query($conn, "SELECT COUNT(*) AS jum,kelompok FROM tracking where admin = 'check' AND picking = '' GROUP BY kelompok");
            while ($data = mysqli_fetch_array($select)) {
                $jum = $data['jum'];
                $grup = $data['kelompok'];
                $link = '';

                if($grup == 'A'){
                    $link = '?url=taska';
                } elseif ($grup == 'B'){
                    $link = '?url=taskb';
                } else {
                    $link = '?url=taskc';
                }
            ?>
                <div class="col-6 mb-2">
                    <div class="card-body pt-0 text-center">
                        <a class="card bg-gradient-info p-5" href="<?=$link?>">
                            <h4> <?= $grup; ?></h4>
                            <span class=" font-weight-bold"> (<?= $jum; ?>)</span>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
            <?php
            $select = mysqli_query($conn, "SELECT COUNT(*) AS jum FROM tracking where admin = 'check' AND picking = '' ");
            while ($data = mysqli_fetch_array($select)) {
                $jum = $data['jum'];
            }
            ?>
            <div class="col-6 mb-2">
                <div class="card-body pt-0 text-center">
                    <a class="card bg-gradient-info p-5" href="?url=taskall">
                        <h4>All</h4>
                        <span class=" font-weight-bold"> (<?= $jum; ?>)</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function updateHiddenField(input) {
        const displayQuantity = input.value;
        const parentRow = input.parentElement.parentElement;
        const hiddenField = parentRow.querySelector('input[name="quantity[]"]');
        hiddenField.value = displayQuantity;
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleNama(index) {
        var nama = document.getElementById('nama' + index);
        var toggler = document.getElementById('toggler' + index);
        if (nama.textContent === nama.dataset.short) {
            nama.textContent = nama.dataset.full;
            toggler.textContent = '<';
        } else {
            nama.textContent = nama.dataset.short;
            toggler.textContent = '>';
        }
    }
</script>
<script>
    // JavaScript code
    // Function to initialize the DataTable
    function initializeDataTable() {
        if (!$.fn.DataTable.isDataTable('#myTable')) {
            const dataTable = $('#myTable').DataTable({
                // Add your DataTable initialization options here
            });
            // Handle pagination events
            dataTable.on('page.dt', function() {
                showMobileCards();
            });
        }
    }
    // Function to handle card clicks
    function handleCardClick(event) {
        event.preventDefault();
        // Add your logic here for card click event
    }
    // Function to show mobile cards based on pagination
    function showMobileCards() {
        const startIndex = (mobileCurrentPage - 1) * mobileItemsPerPage;
        const endIndex = startIndex + mobileItemsPerPage;
        $('#mobileCardContainer .card').hide();
        $('#mobileCardContainer .card').slice(startIndex, endIndex).show();
    }
    // Variables to track pagination state
    let mobileCurrentPage = 1;
    const mobileItemsPerPage = 10; // Number of items to show per page
    // Check the viewport width and show/hide elements based on screen size
    function updateLayout() {
        const desktopTableContainer = document.getElementById('desktopTableContainer');
        const mobileCardContainer = document.getElementById('mobileCardContainer');
        if (window.innerWidth < 1080 && window.innerHeight < 900) {
            desktopTableContainer.style.display = 'none';
            mobileCardContainer.classList.remove('d-none');
            // Initialize DataTable
            initializeDataTable();
            showMobileCards();
        } else {
            desktopTableContainer.style.display = 'block';
            mobileCardContainer.classList.add('d-none');
            // Destroy DataTable
            if ($.fn.DataTable.isDataTable('#myTable')) {
                $('#myTable').DataTable().destroy();
            }
        }
    }
    // Initial layout update on page load
    updateLayout();
    // Listen for window resize events and update layout accordingly
    window.addEventListener('resize', updateLayout);
    // Handle mobile pagination events
    $('#mobilePreviousPage').click(function(event) {
        event.preventDefault();
        if (!$(this).hasClass('disabled')) {
            mobileCurrentPage--;
            showMobileCards();
        }
    });
    $('#mobileNextPage').click(function(event) {
        event.preventDefault();
        if (!$(this).hasClass('disabled')) {
            mobileCurrentPage++;
            showMobileCards();
        }
    });
    // Attach click event listeners to each card
    const cards = document.querySelectorAll('#mobileCardContainer .card');
    cards.forEach(function(card) {
        card.addEventListener('click', handleCardClick);
    });
</script>
<script>
    // JavaScript to hide the data when the user is on a mobile device
    document.addEventListener("DOMContentLoaded", function() {
        var isMobile = <?php echo $_SESSION['is_mobile'] ? 'true' : 'false'; ?>;
        if (isMobile) {
            var dataContainer = document.getElementById("dataContainer");
            dataContainer.style.display = "none";
        }
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#searchInput").on("keyup", function() {
            var searchText = $(this).val().toLowerCase();
            $(".card").each(function() {
                var cardText = $(this).text().toLowerCase();
                if (cardText.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>