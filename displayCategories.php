
<div class="col-12 d-flex flex-row justify-content-center aboutSection mb-5">
    <div class="col-8 d-flex flex-column align-items-center">

        <div class="col-12">
            <h1 class="text-uppercase text-center fw-bold">Discover the easiest way to purchase the products you adore.</h1>
        </div>
        <div class="row">
            <?php
            $categories = getAllActive("categories");

            if (mysqli_num_rows($categories)>0)
            {
                foreach ($categories as $item)
                {
                    ?>

                    <div class="col-11 d-flex flex-row justify-content-between mt-5">
                        <div class="d-flex flex-row align-items-center gap-5 col-md-3">
                            <div class="d-flex flex-row">
                                <img src="upload/<?=$item['images']?>" alt="category Image" class="w-100 remove-bg">
                                <h4 class="text-center mt-3 mb-3"><?=$item['name']?></h4>
                            </div>
                        </div>
                    </div>


                    <?php

                }
            }else{
                echo "no data available";
            }

            ?>
        </div>
    </div>
</div>