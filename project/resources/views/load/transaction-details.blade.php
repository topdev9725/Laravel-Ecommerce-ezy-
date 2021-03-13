						<div class="content-area no-padding">
							<div class="add-product-content">
								<div class="row">
									<div class="col-lg-12">
										<div class="product-description">
											<div class="body-area">
                                    <div class="table-responsive show-table">
                                        <table class="table">
                                            <tr>
                                                <th width="50%">{{ $langg->lang840 }}</th>
                                                <td>{{ $data->created_at  }}</td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ $langg->lang334 }}</th>
                                                <td>{{ $data->type == 'plus' ? '+':'-' }}{{ App\Classes\Common::formatPrice($data->amount)  }}</td>
                                            </tr>
                                            <tr>
                                                <th width="50%">{{ $langg->lang840 }}</th>
                                                <td>{{ $data->txn_number }}</td>
                                            </tr>
                                            @if($data->method != null)
                                            <tr>
                                                <th width="50%">{{ $langg->lang332 }}</th>
                                                <td>{{ $data->method  }}</td>
                                            </tr>
                                            @endif
                                            @if($data->txnid != null)
                                            <tr>
                                                <th width="50%">{{ $data->method  }} {{ $langg->lang840 }}</th>
                                                <td>{{ $data->txnid }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <th width="50%">{{ $langg->lang828 }}</th>
                                                <td>{!! $data->details !!}</td>
                                            </tr>

                                        </table>
                                    </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>