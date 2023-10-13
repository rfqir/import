<?php
if (empty($_GET['noresi'])) {
    $resi =  $_POST['noresi'];
} else {
    $resi = $_GET['noresi'];
}
?>
<div id="tableContainer">
    <div class="col-xl-6">
        <div class="modal-body">
            <div class="card-body">
                <form method="post" action="">
                    <div class="card">
                        <div class="card-header bg-gradient-success text-white text-center">
                            <?= $resi; ?>
                        </div>
                        <?php
                        $select = mysqli_query($conn, "SELECT * FROM shop_id,toko_id,product_toko_id where toko_id.id_product = shop_id.id_product AND product_toko_id.id_product = shop_id.id_product AND resi = '$resi'");
                        while ($list = mysqli_fetch_array($select)) {
                            $gambar = $list['image'];
                            if ($gambar == null) {
                                // jika tidak ada gambar
                                $img = '<img src="../../assets/img/noimageavailable.png" class="zoomable avatar avatar-sm rounded-circle me-2">';
                            } else {
                                //jika ada gambar
                                $img = '<img src="../../assets/img/' . $gambar . '" class="zoomable avatar avatar-sm rounded-circle me-2">';
                            }
                            $color = "";
                        ?>
                            <div class="mt-2" style="<?= $color; ?>">
                                <div class="d-flex justify-space-between text-sm ms-3 me-2 ">
                                    <?= $img; ?>
                                    <?= $list['nama']; ?>
                                </div>
                                <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">
                                    <strong>SKU:</strong> <?= $list['sku_toko']; ?>&nbsp;&nbsp;&nbsp;
                                    <strong>Quantity:</strong> <?= $list['jumlah']; ?>
                                    <input type="text" value="<?=$list['id_product']?>">
                                </div>
                                <div class="d-flex justify-space-between text-sm" style="margin-left: 20px;">
                                    <strong>Status:</strong>&nbsp;&nbsp;&nbsp;
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="invoice">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            function redirectPage(id_request) {
                // Change the destination URL according to your needs
                window.location.href = "index.php?url=ds&idds=" + id_request;
            }
        </script>
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