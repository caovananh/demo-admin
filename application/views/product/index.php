<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
            </br>
            <form action="" method="GET">
                <div class="row">                   
                    <div class="col-sm-1">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : ''; ?>" class="form-control" placeholder="Type ID">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group input-group-sm mb-3">
                            <input type="text" name="name" value="<?= isset($_GET['name']) ? $_GET['name'] : ''; ?>" class="form-control" placeholder="Type Name">
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <button type="submit" name="search" class="btn btn-info">Search</button>
                    </div>
                    <div class="col-sm-2">
                        <a href="<?=base_url('index.php/product/add') ?>" class="btn btn-info">Thêm mới</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên Sản Phẩm</th>
                            <th scope="col">Giá </th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list as $key => $obj) { ?>
                            <tr>
                                <th scope="row"><?= $key + 1; ?></th>
                                <td><?= $obj->name; ?></td>
                                <td><?= $obj->price; ?></td>
                                <td>
                                    <?php
                                    $url_stt = base_url('index.php/product/changeStatus?id=').$obj->id .'&status=' . $obj->status;
                                    $url_delete =base_url('index.php/product/delete?id=').$obj->id ;
                                    $url_edit = base_url('index.php/product/edit?id=').$obj->id ;
                                    ?>
                                    <?php if ($obj->status == 1) { ?>
                                        <a href="<?= $url_stt ?>" class="btn btn-primary"> Active </a>
                                    <?php } else { ?>
                                        <a href="<?= $url_stt ?>" class="btn btn-outline-secondary">Inactive</a>
                                    <?php } ?>
                                <td><?= date("H:i:s d-m-Y", $obj->created); ?></td>
                                <td>
                                    <a href="<?= $url_delete?>" value= "<?=$obj->id?>" class="btn btn-info">Delete</a>
                                    <a href="<?= $url_edit ?>" class="btn btn-info">Update</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <p><?= $this->pagination->create_links()?></p>
            </div>
        </div>
    </div>

</div>