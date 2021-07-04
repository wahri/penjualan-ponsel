		<?php 
		foreach ($user_parent as $users) { 
		?>	
				<tr>
					<td><?php echo $users->name; ?>ssss</td>
					<td><?php echo $users->username; ?></td>
					<td><?php echo $users->first_name; ?> <?php echo $users->last_name; ?></td>
					<td><?php echo $users->email; ?></td>
					<td>
						<?php 
							if($users->active == 1){
								$st=0;
								echo '<span class="label label-primary btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk me non aktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$users->id.'">Aktive</span>';
							}else{
								$st=1;
								echo '<span class="label label-danger btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk mengaktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$users->id.'">Non Aktive</span>';
							}
						?>
					</td>
					<td>
						<a href="<?php echo url_web('admin/user/edit/' . $users->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i></a>
					</td>
				</tr>
				
				<?php 
					$child = $this->costume->get_child_user($users->id);
					foreach ($child as $child) {
				?>
					<tr>
						<td><i class="fa fa-level-down"></i> <?php echo $child->name; ?></td>
						<td><?php echo $child->username; ?></td>
						<td><?php echo $child->first_name; ?> <?php echo $child->last_name; ?></td>
						<td><?php echo $child->email; ?></td>
						<td>
							<?php 
								if($child->active == 1){
									$st=0;
									echo '<span class="label label-primary btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk me non aktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$child->id.'">Aktive</span>';
								}else{
									$st=1;
									echo '<span class="label label-danger btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk mengaktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$child->id.'">Non Aktive</span>';
								}
							?>
						</td>
						<td>
							<a href="<?php echo url_web('admin/user/edit/' . $child->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i></a>
						</td>
					</tr>
					<?php 
						$childest = $this->costume->get_child_user($child->id);
						foreach ($childest as $childest) {
					?>
						<tr>
							<td><i class="fa fa-ellipsis-h"></i><i class="fa fa-level-down"></i> <?php echo $childest->name; ?></td>
							<td><?php echo $childest->username; ?></td>
							<td><?php echo $childest->first_name; ?> <?php echo $childest->last_name; ?></td>
							<td><?php echo $childest->email; ?></td>
							<td>
								<?php 
									if($child->active == 1){
										$st=0;
										echo '<span class="label label-primary btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk me non aktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$childest->id.'">Aktive</span>';
									}else{
										$st=1;
										echo '<span class="label label-danger btn-status" style="cursor: pointer; cursor: hand;" data-toggle="tooltip" data-placement="left" title="Klik untuk mengaktifkan" data-href="'.url_web("admin/user/set_status").'" data-status="'.$st.'" data-value="'.$childest->id.'">Non Aktive</span>';
									}
								?>
							</td>
							<td>
								<a href="<?php echo url_web('admin/user/edit/' . $childest->id); ?>" style="border-right: 1px solid #999;padding: 0 10px;"><i class="fa fa-edit"></i></a>
							</td>
						</tr>
				
		<?php 
						}
				}
		}
		?>	
		