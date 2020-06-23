<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Pembelian</th>
										<th>Kode Barang</th>
										<th>Nominal</th>
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
										<td><?=$dt->kode_barang?></td>
										<td><?=$dt->nominal?></td>
										<td><?=$dt->status?></td>
										<td><a href="<?php echo base_url('toko/proses_bayar/'.$dt->id)?>" class="btn btn-danger"><i class="fa fa-edit"></i> Bayar</a></td>
									</tr>
								<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>