<!-- Page Wrapper -->
<div id="wrapper">


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">



            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
                    <h1 class="h3 mb-0 text-gray-800">TrendPress / Ürün Çek</h1>

                </div>

                <!-- Content Row -->
                <div class="row">
                    <?php
                    $count_posts = wp_count_posts( 'product' );

                    ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Toplam Ürün Sayısı</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_posts->publish+$count_posts->draft; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Aktif Ürün Sayısı</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_posts->publish ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Taslak Ürün Sayısı
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $count_posts->draft ?></div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                           Bekleyen Ürün Sayısı</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_posts->pending ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Row -->

                <div class="row">

                    <!-- Area Chart -->
                    <div class="col-md-12">
                        <div class="card shadow mb-4 col-md-12">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kategoriden Çekin</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">

                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="source_category">Kaynak Kategori</label>

                                              <input type="text" id="source_category" class="form-control" name="source_category" placeholder="bluetooth-kulaklik-x-c108626" />
                                                <br>
                                                <small>Trendyoldan aldığınız linkin son kısmını yapıştırınız. <br> Örnek :
                                                    https://www.trendyol.com/<strong>bluetooth-kulaklik-x-c108626</strong>
                                                    <br>
                                                    Buradaki koyu alanı yapıştırınız</small>
                                            </div>

                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="commission_type">Komisyon Türü</label>
                                                <select class="form-control" name="commission_type" id="commission_type">
                                                    <option value="0">Yüzde</option>
                                                    <option value="1" selected>Net Tutar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="commission_amount">Komisyon Oranı</label>

                                                <input type="text" id="commission_amount" class="form-control" name="commission_amount" placeholder="10" value="10" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example2">Eklenecek Kategori</label>
                                                <select id="my_category" class="form-control">
                                                    <option value="0">Otomatik Oluştur</option>
                                                    <?php
                                                    $args = array(
                                                        'taxonomy' => 'product_cat',
                                                        'hide_empty' => false,
                                                        'parent'   => 0
                                                    );
                                                    $product_cat = get_terms( $args );
                                                    foreach ($product_cat as $parent_product_cat)
                                                    {
                                                        echo '
     <option value="'.$parent_product_cat->term_id.'">'.$parent_product_cat->name.'</option>
          ';
                                                        $child_args = array(
                                                            'taxonomy' => 'product_cat',
                                                            'hide_empty' => false,
                                                            'parent'   => $parent_product_cat->term_id
                                                        );
                                                        $child_product_cats = get_terms( $child_args );
                                                        foreach ($child_product_cats as $child_product_cat)
                                                        {
                                                            echo '<option value="'.$child_product_cat->term_id.'">---'.$child_product_cat->name.'</option>';
                                                        }

                                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Resimlere Fligran</label>
                                                <select class="form-control" id="fligran">
                                                    <option value="1">Evet</option>
                                                    <option value="0">Hayır</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example2">Spinleme</label>
                                                <select class="form-control" id="spin">
                                                    <option value="1">Evet</option>
                                                    <option value="0">Hayır</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Paylaşım Durumu</label>
                                                <select class="form-control" id="publish_status">
                                                    <option value="draft">Taslak</option>
                                                    <option value="publish">Paylaş</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example2">Çift Spin</label>
                                                <select class="form-control" id="double_spin">
                                                    <option value="1">Evet</option>
                                                    <option value="0">Hayır</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="button" class="btn btn-primary btn-block mb-4" onclick="by_categories()">Çekimi Başlat</button>



                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->


