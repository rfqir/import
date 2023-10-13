<?php

$sku = isset($_GET['sku']) ? $_GET['sku'] : '';

// Buat kondisi untuk memeriksa apakah $sku ada nilai atau kosong

$noresi = '';

if (!empty($sku)) {

    $noresi = "AND no_resi LIKE'%$sku%'";
}

?>

<div id="tableContainer">

    <div class="row">
    <div class="modal-body mb-1">
        <div class="card bg-gray-100">
            <form action="?url=ds" method="post">
                <div class="row m-2">
                    <span class="ms-3">Resi</span>
                    <div class="d-flex justify-content-between m-2">
                        <input type="number" class="form-control" name="inv" placeholder="Masukan No Resi">
                        <button type="submit" class="btn btn-primary ms-2" name="cekinv">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="modal-body">
            <div class="card bg-gray-100">
                <?php
                $select = mysqli_query($conn, "SELECT no_resi FROM tracking where admin = 'check' AND picking = '' AND kelompok = 'B' $noresi");
                while ($data = mysqli_fetch_array($select)) {
                    $resi = $data['no_resi'];
                    $button = "redirectPage(" . $resi . ")";
                    ?>
                        <a href="?url=resi&noresi=<?=$resi;?>">
                        <div class="card bg-gradient-primary m-2">
                            <div class="card-body text-white text-center">
                                <?= $resi; ?>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
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