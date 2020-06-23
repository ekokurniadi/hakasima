<div class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
					<h3>Tentang Kami</h3>
					</div>
                    <div class="col-md-12">
                        <table>
                        <?php $tentang=$this->db->query("select * from tentang limit 1")->row_array();?>
                        <tr>
                            <th>
                                <h5><?=$tentang['tentang_kami']?></h5>
                            </th>
                        </tr>
                        </table>
                    </div>
				</div>
			</div>
		</div>
