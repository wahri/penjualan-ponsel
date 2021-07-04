<?php if (!empty($berita_tinjau)) { ?>
    <?php foreach ($berita_tinjau as $lists) { ?>
        <tr class="even pointer list-baris-article">
			<td>
				<?php echo '<b style="color:#dc3232"><a href="'.url_web('admin/berita/edit/'.$lists->id) .'"-- Menunggu Persetujuan </b>'.'<b> ('.$lists->judul_berita.')</a></b>';?>
			</td>
			<td><?php echo $lists->first_name.' '.$lists->last_name; ?></td>
			<td><?php 
					$trcat = $this->costume->get_kategori_berita($lists->id);
					foreach ($trcat as $cat_pr){ echo $cat_pr -> kat.', '; } 
				?>
			</td>
            <td><?php echo $lists->format_berita; ?></td>
			<td><?php echo $lists->status_terbit; ?></td>
			<td><?php echo tgl_indo_timestamp($lists->create_time); ?></td>
			<td><?php echo $lists->real_viewer; ?></td>
        </tr>
    <?php } ?>
<?php } else { ?>
    <tr class="even pointer list-baris-article">
		<td colspan="7">Tidak ada berita yang di koreksi</td>
	</tr>
<?php } ?>
