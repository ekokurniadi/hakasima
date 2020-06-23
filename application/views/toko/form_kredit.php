		<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Pengajuan</th>
										<th>Tanggal</th>
										<th>Nama Barang</th>
										<th>Foto Barang</th>
										<th>Jumlah</th>
										<th>Harga</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								<?php 
								$no=1;
								foreach($detail as $dt):?>
									<tr>
										<td><?=$no++;?></td>
										<td><?=$dt->id_prospek?></td>
										<td><?=tgl_indo($dt->tanggal);?></td>
										<td><?=$dt->nama_barang?></td>
										<?php $foto=$this->db->query("select * from barang where kode_barang='$dt->kode_barang'")->row_array();?>
										<td><img src="<?= base_url('image/'.$foto['foto'])?>" alt="Foto Barang" width="100px" height="100px;"></td>
										<td><?=$dt->jumlah?></td>
										<td><?=$dt->jumlah?></td>
										<td><?=$dt->status?></td>
										<?php if($dt->status=="baru"){?>
										<td style="text-align:center;">
											<a href="<?php echo base_url('prospek/hapus/'.$dt->id_prospek)?>" class="btn btn-sm btn-danger" title="hapus"><i class="fa fa-trash"></i></a>
										</td>
										<?php }elseif($dt->status=="NOT DEAL"){?>
										<td style="text-align:center;">
											<a href="<?php echo base_url('prospek/ajukan/'.$dt->id_prospek)?>" class="btn btn-sm btn-success" title="ajukan"><i class="fa fa-archive"></i></a>
										</td>
										<?php }?>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
