<?php
/*
 *  [fullname] => 
 *  [email] => 
 *  [address] => 
 *  [phone] => 
 *  [note] =>
 *  [payment_method] => 
 *  [products] => []
 *  [created_at] =>
 * 
 */
// covert json sang array
function checkout_mail($order)
{
	$products = json_decode($order['products'], true);
	$info=$order['info'];
	$mail = '<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
		<tr>
			<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
				<tbody>
					<tr>
						<td align="center" id="m_-705899172178319891headerImage" valign="bottom">
						<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid #00b7f1;padding-bottom:10px;background-color:#fff" width="100%">
							<tbody>
							</tbody>
						</table>
						</td>
					</tr>
					
					<tr style="background:#fff">
						<td align="left" height="auto" style="padding:15px" width="600">
						<table>
							<tbody>
								<tr>
									<td>
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<tbody>
											<tr>
												<td><a href="https://tiki.vn/chuong-trinh/mo-the-tikicard" style="display:inline-block;margin-bottom:20px;margin-right:12px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://tiki.vn/chuong-trinh/mo-the-tikicard&amp;source=gmail&amp;ust=1598600565057000&amp;usg=AFQjCNHa5OCwkNsSZCbuCRrxB6JytXQ7_g"><img alt="banner" src="https://ci3.googleusercontent.com/proxy/HoZesAOYeh_OlpC-w9hta4zauUrNctGrgZnUaEQCyqx4n9NYF3BudBoLvm7mqA3gukAmk_EgYxzrbH-b_tbFjAJJtZ8FAzjKa4PWuGGGLezGHKKiFxqxCXSD8qLioaKgbbvn=s0-d-e1-ft#https://salt.tikicdn.com/ts/upload/af/26/70/c859407ed0856f97454eb21689e2f09f.png" width="275" class="CToWUd"> </a></td>
												<td><a href="https://tiki.vn/chuong-trinh/du-lich-gia-re-tet-2019?src=order_confirmation_email" style="display:inline-block;margin-bottom:20px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://tiki.vn/chuong-trinh/du-lich-gia-re-tet-2019?src%3Dorder_confirmation_email&amp;source=gmail&amp;ust=1598600565057000&amp;usg=AFQjCNHm7pZbSM6aAaNbLimTfi0cJyyKJg"><img alt="banner" src="https://ci6.googleusercontent.com/proxy/L27ewKXRtuTpAHKjq6ol6TH92QzCedpMXsXqd2NwfsG9U22pqaAdx6dsGpJI7FnlgYKd6NLqq3xbJIzaRq_IlxiE9jdihvkPQMre-e5bzNrR5nH66_e3qsOWlk_q5uHi6kaXIoRGHXs=s0-d-e1-ft#https://salt.tikicdn.com/media/upload/2018/12/21/f7d3f5d45561853c18e837ecbb7dea3d.jpg" width="275" class="CToWUd"> </a></td>
											</tr>
										</tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td>
									<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách ' . $order['fullname'] . ' đã đặt hàng tại Tiki,</h1>
									
									<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Tiki rất vui thông báo đơn hàng #' . $order['code'] . ' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. Tiki sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>
									
									<h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin đơn hàng #' . $order['code'] . ' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">(' . $order['created_at'] . ')</span></h3>
									</td>
								</tr>
								<tr>
									<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
									<table border="0" cellpadding="0" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
												<th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"> Địa chỉ giao hàng </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">' . $order['fullname'] . '</span><br>
												<a href="mailto:' . $order['email'] . '" target="_blank">' . $order['email'] . '</a><br>
												' . $order['phone'] . '</td>
												<td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">' . $order['fullname'] . '</span><br>
												 <a href="mailto:khuongmy1@gmail.com" target="_blank">' . $order['email'] . '</a><br>' . $order['address'] . '<br>
												 T: ' . $order['phone'] . '</td>
												</tr>
												<tr>
												<td colspan="2" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Phương thức thanh toán: </strong>' . $order['payment_method'] . '<br>
												  <strong>Thời gian giao hàng dự kiến:</strong> Dự kiến giao hàng Thứ bảy, 04/07 - không giao ngày Chủ Nhật  <br>
												<strong>Phí vận chuyển: </strong> 0đ<br>
												<strong>Sử dụng bọc sách cao cấp Bookcare: </strong>  Không <br>
												 </p>
												</td>
											</tr>
										</tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td>
									<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i></p>
									</td>
								</tr>
								<tr>
									<td>
									<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>

									<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
										<thead>
											<tr>
												<th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
												<th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
												<th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
												<th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th>
												<th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
											</tr>
										</thead>
										<tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">';
									foreach($products as $product){
									$mail .='<tr>
												<td align="left" style="padding:3px 9px" valign="top"><span>'.$product['title'].'</span><br>
												</td>
												<td align="left" style="padding:3px 9px" valign="top"><span>'.currency_format($product['price']).'</span></td>
												<td align="left" style="padding:3px 9px" valign="top">'.$product['qty'].'</td>
												<td align="left" style="padding:3px 9px" valign="top"><span>0đ</span></td>
												<td align="right" style="padding:3px 9px" valign="top"><span>'.$product['sub_total'].'</span></td>
											</tr>';
									}
									$mail.='</tbody>
										<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">											<tr>
												<td align="right" colspan="4" style="padding:5px 9px">Tạm tính</td>
												<td align="right" style="padding:5px 9px"><span>'.currency_format($info['total']).'</span></td>
											</tr>
											<tr>
												<td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
												<td align="right" style="padding:5px 9px"><span>0đ</span></td>
											</tr>
											<tr bgcolor="#eee">
												<td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
												<td align="right" style="padding:7px 9px"><strong><big><span>'.currency_format($info['total']).'</span> </big> </strong></td>
											</tr>
										</tfoot>
									</table>
									<div style="margin:auto"><a href="https://tiki.vn/sales/order/trackingDetail?code=587808081" style="display:inline-block;text-decoration:none;background-color:#00b7f1!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:35%;margin-top:5px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://tiki.vn/sales/order/trackingDetail?code%3D587808081&amp;source=gmail&amp;ust=1598600565057000&amp;usg=AFQjCNGj2PzySzb54iu3HwhVt9JQP4UmKw">Chi tiết đơn hàng tại Tiki</a></div>
									</td>
								</tr>
								<tr>
									<td>&nbsp;
									<p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm mục <a href="http://hotro.tiki.vn/hc/vi/?utm_source=transactional+email&amp;utm_medium=email&amp;utm_term=logo&amp;utm_campaign=new+order" title="Các câu hỏi thường gặp" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://hotro.tiki.vn/hc/vi/?utm_source%3Dtransactional%2Bemail%26utm_medium%3Demail%26utm_term%3Dlogo%26utm_campaign%3Dnew%2Border&amp;source=gmail&amp;ust=1598600565057000&amp;usg=AFQjCNFhhDA_tjnX0JmZ6NMKFEfekhuWYA"> <strong>các câu hỏi thường gặp</strong>.</a></p>
									
									<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">Từ ngày 14/2/2015, Tiki sẽ không gởi tin nhắn SMS khi đơn hàng của bạn được xác nhận thành công. Chúng tôi chỉ liên hệ trong trường hợp đơn hàng có thể bị trễ hoặc không liên hệ giao hàng được.</p>
									
									<p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Bạn cần được hỗ trợ ngay? Chỉ cần email <a href="mailto:hotro@tiki.vn" style="color:#099202;text-decoration:none" target="_blank"> <strong>hotro@tiki.vn</strong> </a>, hoặc gọi số điện thoại <strong style="color:#099202">1800-6963</strong> (8-21h cả T7,CN). Đội ngũ Tiki Care luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>
									</td>
								</tr>
								<tr>
									<td>&nbsp;
									<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">Một lần nữa Tiki cảm ơn quý khách.</p>

									<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="http://tiki.vn?utm_source=transactional+email&amp;utm_medium=email&amp;utm_term=logo&amp;utm_campaign=new+order" style="color:#00a3dd;text-decoration:none;font-size:14px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://tiki.vn?utm_source%3Dtransactional%2Bemail%26utm_medium%3Demail%26utm_term%3Dlogo%26utm_campaign%3Dnew%2Border&amp;source=gmail&amp;ust=1598600565057000&amp;usg=AFQjCNG_hRjn1r0ZRs7VQJl8sSBMKc3tQQ">Tiki</a> </strong></p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td align="center">
			<table width="600">
				<tbody>
					<tr>
						<td>
						<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">Quý khách nhận được email này vì đã mua hàng tại Tiki.<br>
						Để chắc chắn luôn nhận được email thông báo, xác nhận mua hàng từ Tiki, quý khách vui lòng thêm địa chỉ <strong><a href="mailto:hotro@tiki.vn" target="_blank">hotro@tiki.vn</a></strong> vào số địa chỉ (Address Book, Contacts) của hộp email.<br>
						<b>Văn phòng Tiki:</b> 52 Út Tịch, phường 4, quận Tân Bình, thành phố Hồ Chí Minh, Việt Nam<br>
						Bạn không muốn nhận email từ Tiki? Hủy đăng ký tại <a>đây</a>.</p>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>';
	return $mail;
}
