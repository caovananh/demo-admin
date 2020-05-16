


<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Cập nhật sản phẩm</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <?php if(validation_errors()) { ?>
        <div class="alert alert-danger">
            <ul>
                <?php echo validation_errors(); ?>
            </ul>
        </div>
     <?php } ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="card-body">
        <?php foreach ($update as $key => $obj) { ?>
            <div class="row">     
                <div class="col-sm-2">
                    <label>Chọn trạng thái</label>
                </div>                          
                <div class="col-sm-10">
                    <div class="input-group input-group-sm mb-3">
                    <select name="status">  
                            <option value="<?= ($obj->status==0)? 1 : 0 ?>"><?= ($obj->status==0) ? 'Active' : 'Inactive' ?></option> 
                            <option value= "<?= $obj->status ?> " selected><?= ($obj->status==0) ? 'Inactive' : 'Active' ?></option>
                              
                    </select>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Nhập tên</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="name" value="<?=set_value('name')?set_value('name') :$obj->name  ; ?>"  class="form-control">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Nhập giá </label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group input-group-sm mb-3">
                        <input type="text" name="price" value="<?= $obj->price; ?>" class="form-control">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Nhập detail</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group input-group-sm mb-3">
                        <textarea name="detail"  class="form-control" rows="5" id="comment"><?= $obj->detail; ?></textarea>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Nhập description</label>
                </div>
                <div class="col-sm-10">
                    <div class="input-group input-group-sm mb-3">
                        <textarea name="description"  class="form-control" rows="5" id="comment"><?= $obj->description; ?></textarea>
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label>Chọn hình</label>
                </div>
                <div class="col-sm-10">
                    <div class="">
                        <input type="file" name="image">
                    </div> 
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button type="submit" name="submit" class="btn btn-primary">Lưu</button>
                    <a href="<?=base_url()?>" class="btn btn-primary">Hủy bỏ</a>
                </div>
            </div>
        <?php } ?>
        </form>
    </div>

