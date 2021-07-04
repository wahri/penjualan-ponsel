<?php if (!empty($page_parent)) { ?>
    <?php foreach ($page_parent as $lists) { ?>
        <tr class="even pointer list-baris-article">
			<td><?php echo $lists->judul_page; ?></td>
            <td><?php echo tgl_indo_timestamp($lists->published_at); ?></td>
			<td>
                <a href="<?php echo url_web('admin/halaman/edit/').$lists->id; ?>" class="text-danger" style="padding: 0 10px;"><i class="fa fa-edit"></i> Sunting</a>
				<a data-href="<?php echo url_web('admin/halaman/delete_'); ?>" data-id="<?php echo $lists->id; ?>" data-title="<?php echo $lists->judul_page; ?>"  class="text-danger btn-delete-data" style="padding: 0 10px;"><i class="fa fa-trash"></i> Hapus</a>
			</td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <div><p>Data tidak ditemukan</p></div>
<?php } ?>