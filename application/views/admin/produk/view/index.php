<?php $this->load->view('theme/t_head'); ?>
<?php $this->load->view('theme_admin/t_sidebar_nav'); ?>
<?php $this->load->view('theme/t_top_nav'); ?>
<style>
  .form-controli-feedback {
    margin-top: 8px;
    height: 23px;
    color: #bbb;
    line-height: 20px;
    font-size: 15px;
  }

  .form-controli-feedback.left {
    border-right: 1px solid #ccc;
    left: 4px;
  }

  .form-control.has-feedbacki-left {
    padding-left: 45px;
  }

  .has-feedbacki .form-control {
    padding-right: 42.5px;
  }

  .form-controli-feedback {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    display: block;
    width: 34px;
    text-align: center;
    pointer-events: none;
  }
</style>

<div class="right_col" role="main">
  <div class="">
    <div class="row">
      <div class="col-xs-12 invoice-header">
        <h1><i class="fa fa-rss"></i> <?php echo $title; ?> <a href="<?php echo url_web('admin/produk/add'); ?>" class="btn btn-default submit">+ Tambah Baru</a></h1>
      </div>
    </div>
    <div class="x_title"></div>

    <div class="row">
      <?php if (!empty($this->session->flashdata('success'))) { ?>
        <div class="alert alert-success alert-dismissible fade in" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
          </button>
          <strong>Pesan..!!</strong> <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php } ?>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-8 col-sm-8 col-xs-12 form-group pull-left ">
          <div class="row">
            <form action="<?php echo site_url('admin/produk/index'); ?>" method="post">
              <div class="form-inline">
                <div class="form-group">
                  <select name="etalase_select" id="etalase_select" class="form-control input-sm">
                    <?php $this->load->view('admin/produk/lib/select_estalase'); ?>
                  </select>
                </div>
                <div class="form-group">
                  <select name="merek_select" id="merek_select" class="form-control input-sm">
                    <?php $this->load->view('admin/produk/lib/select_merek'); ?>
                  </select>
                </div>
                <button type="submit" name="filter_button" class="btn btn-default btn-sm btn-info">Penyaringan</button>
                <?php
                if ($reset_select == 1) {
                  echo '<button type="submit" name="reset_button" class="btn btn-sm btn-default">Reset Filter</button>';
                }
                ?>
              </div>
            </form>
          </div>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
          <div class="row">
            <div class="form-group">
              <div class="input-group">
                <input type="text" id="inputSearchArticle" data-href="<?php echo url_web('admin/produk/search'); ?>" class="form-control" placeholder="cari produk...">
                <span class="input-group-btn">
                  <button class="btn btn-default active" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
        </div>

        <div class="x_panel">
          <?php echo $result_count; ?>
          <div class="x_content">

            <table class="table">
              <thead>
                <tr>
                  <th colspan="2">Produk</th>
                  <th>Info</th>
                  <th>Status</th>
                  <th><i class="fa fa-cogs"></i></th>
                </tr>
              </thead>
              <tbody id="tbodySearch">
                <?php $this->load->view('admin/produk/lib/list_page'); ?>
              </tbody>
            </table>
          </div>
          <nav id="nav-index">
            <?php
            echo $this->pagination->create_links();
            ?>
          </nav>
        </div>
      </div>

    </div>
  </div>
</div>
<script>
  $('body').on('click', '.btn-delete-data', function() {
    var idItem = $(this).attr('data-id');
    var title = $(this).attr('data-title');
    var href = $(this).attr('data-href');

    swal({
        title: "Are you sure?",
        text: "Your will delete " + title + "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
      },
      function() {
        swal("Deleted!", "Your data " + title + " has been deleted.", "success");
        $.ajax({
          url: href,
          type: 'post',
          dataType: 'json',
          data: {
            id: idItem
          },
          success: function(msg) {

          }
        });
        setTimeout(function() {
          location.reload();
        }, 800);
      });
  });

  /*fungsi Pencarian*/
  $('#inputSearchArticle').on('input', function(event) {
    var url = $(this).attr('data-href');
    var inputan = $(this).val();
    $.ajax({
      url: url,
      type: 'post',
      dataType: 'json',
      dataType: 'html',
      data: {
        search: inputan
      },
      success: function(msg) {
        $('#tbodySearch').html(msg);
      }
    });
  });
</script>

<?php $this->load->view('theme/t_footer'); ?>
<!-- /page content -->