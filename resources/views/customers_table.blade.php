  <table  class="table table-bordered table-striped" >
                        <thead>
                           <tr>
                              <th>id</th>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Sex</th>
							  <th>OTP</th>
                              <th>Status</th>
                             
                           </tr>
                        </thead>
                        <tbody>
                           @php 
                           $i=1;
                           @endphp
                           @foreach($customers as $key)
                           <tr>
                           <td>{{$i}}</td>
                              <td>{{$key->name}}</td>
                              <td>{{$key->phnum}}</td>
                              <td>@if($key->sex==1) Male @elseif($key->sex==2) Female @endif</td>
							   <td>{{$key->otp}}</td>
                              <td> @if($key->status==1)
                    <i class="fa fa-check text-success"  aria-hidden="true" ></i>
                    @else
                    <i class="fa fa-times text-danger"  aria-hidden="true" ></i>
                    @endif</td>
                            
                           </tr>
                           @php 
                           $i++;
                           @endphp
                           @endforeach
                        </tbody>
                        <tfoot>
                           <tr>
						     <th>id</th>
                             <th>Name</th>
                              <th>Phone Number</th>
                              <th>Sex</th>
							  <th>OTP</th>
                              <th>Status</th>
                            </tr>
                        </tfoot>
                     </table>
                     <div class="clearfix">
                     
                     {!! $customers->render( "pagination::bootstrap-4") !!}
