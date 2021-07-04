<?php
 
 header("Content-type: application/octet-stream");
 
 header("Content-Disposition: attachment; filename=$filename.xls");
 
 header("Pragma: no-cache");
 
 header("Expires: 0");
 
 ?>
 
 <table border="1" width="100%">
 
      <thead>
 
           <tr>
				<th>INVOICE</th>
                <th>TANGGAL</th>
                <th>WAKTU</th>
				<th>PELANGGAN</th>
				<th>TELPON</th>
				<th>STATUS</th>
				<th>TOTAL BELANJA</th>
				<th>CATATAN</th>
           </tr>
 
      </thead>
 
      <tbody>
 
           <?php foreach($paper_parent as $lists_paper) { ?>
 
           <tr>
 
                <td><?php echo $lists_paper->no_transaksi; ?></td>
                <td><?php echo date('d-m-Y', strtotime($lists_paper->tanggal)); ?></td>
                <td><?php echo date('H:i:s', strtotime($lists_paper->tanggal)); ?></td>
				<td><?php echo $lists_paper->pelanggan; ?></td>
				<td><?php echo $lists_paper->hp; ?></td>
				<td><?php echo $lists_paper->status; ?></td>
				<td><?php echo $lists_paper->total; ?></td>
				<td><?php echo $lists_paper->catatan; ?></td>
 
           </tr>
 
           <?php } ?>
 
      </tbody>
 
 </table>
 
