@extends('vendor.vendor_dashboard')
@section('vendor')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Product</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>
   
    </div>
    <!--end breadcrumb-->

  <div class="card">
      <div class="card-body p-4">
          <h5 class="card-title">Edit Product</h5>
          <hr/>

          <form action="{{ route('vendor.update.product',$product->id)}}" method="post" id="myForm"  >
            @csrf

           <div class="form-body mt-4">

            <div class="row">
               <div class="col-lg-8">
               <div class="border border-1 p-4 rounded">
                <div class="mb-3 form-group">
                    <label for="inputProductTitle" class="form-label">Product Name</label>
                    <input type="text" name="product_name" class="form-control" id="inputProductTitle" placeholder="Enter product title" value="{{ $product->product_name}}">
                  </div>

                  <div class="mb-3 form-group">
                    <label for="inputProductTitle" class="form-label">Product Tags</label>
                    <input type="text" name="product_tags" class="form-control visually-hidden" data-role="tagsinput"  value="{{ $product->product_tags}}">
                  </div>
                  <div class="mb-3 form-group">
                    <label for="inputProductTitle" class="form-label">Product Size</label>
                    <input type="text" name="product_size" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_size}}">
                  </div>
                  <div class="mb-3 form-group">
                    <label for="inputProductTitle" class="form-label">Product Color</label>
                    <input type="text" name="product_color" class="form-control visually-hidden" data-role="tagsinput" value="{{ $product->product_color}}">
                  </div>


                  <div class="mb-3 form-group">
                    <label for="inputProductDescription" class="form-label">Short Description</label>
                    <textarea class="form-control" name="short_descp" id="inputProductDescription" rows="3">{!! $product->short_descp !!}</textarea>
                  </div>
                  <div class="mb-3 form-group">
                    <label for="inputProductDescription" class="form-label">Long Description</label>
                    <textarea id="mytextarea" name="long_descp">{!! $product->long_descp !!}</textarea>
                </div>

                {{-- <div class="mb-3 form-group">
                    <label for="inputProductDescription" class="form-label">Main Thambnail</label>
                    <input class="form-control" name="product_thambnail" type="file" id="formFile" onChange="mailThumUrl(this)">
                     <img src="" alt="" id="mailThumb">

                  </div>

                  <div class="mb-3 form-group">
                    <label for="inputProductDescription" class="form-label">Multiple Thambnail</label>
                     <input class="form-control" type="file" id="multiImage" multiple="" name="multi_image[]" > 
                    <div class="row" alt="" id="preview_img">

                    </div>
                </div> --}}
       
              
                </div>
               </div>
               <div class="col-lg-4">
                <div class="border border-1 p-4 rounded">
                  <div class="row g-3">
                    <div class="col-md-6 form-group">
                        <label for="inputPrice" class="form-label">Product Price</label>
                        <input type="text" name="selling_price"  class="form-control" id="inputPrice" placeholder="00.00" value="{{ $product->selling_price }}">
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="inputPrice" class="form-label">Discount Price</label>
                        <input type="text" name="discount_price"  class="form-control" id="inputPrice" placeholder="00%" value="{{ $product->discount_price }}">
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="inputCompareatprice" class="form-label">Product Code</label>
                        <input type="text" name="product_code" class="form-control" id="inputCompareatprice" placeholder="00" value="{{ $product->product_code }}">
                      </div>
                      <div class="col-md-6 form-group">
                        <label for="inputCompareatprice" class="form-label">Product-Quantity</label>
                        <input type="text" name="product_qty" class="form-control" id="inputCompareatprice" placeholder="00" value="{{ $product->product_qty }}">
                      </div>
                  
                     
                      <div class="col-12 form-group">
                        <label for="inputProductType" class="form-label">Product Brand</label>
                        <select  name="brand_id" class="form-select" id="inputProductType">
                            <option></option>
                            @foreach ($brand as $item)
                               <option value="{{ $item->id}}" {{ $item->id == $product->brand_id ? 'selected' : ''}}  >{{ $item->brand_name}}</option>

                            @endforeach
                            {{-- <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option> --}}
                          </select>
                      </div>
                      <div class="col-12 form-group">
                        <label for="inputVendor" class="form-label">Product Category</label>
                        <select name="category_id" class="form-select" id="inputVendor">
                            <option></option>
                            @foreach ($category as $item)
                            <option value="{{ $item->id}}" {{ $item->id == $product->category_id ? 'selected' : ''}}>{{ $item->category_name}}</option>

                         @endforeach
                          </select>
                      </div>
                      <div class="col-12 form-group">
                        <label for="inputCollection" class="form-label">Product Subcategory</label>
                        <select  name="subcategory_id" class="form-select" id="inputCollection">
                            <option></option>
                            
                            @foreach ($subcategory as $item)
                               <option value="{{ $item->id}}" {{ $item->id == $product->subcategory_id ? 'selected' : ''}}>{{ $item->subcategory_name}}</option>

                           @endforeach
                          </select>
                      </div>
                  

                    <div class="row g-3">
                      <div class="col-md-6">
                     
                        <div class="form-check">
                            <input class="form-check-input" name="hot_deals" type="checkbox" value="1" {{ $product->hot_deals ==1 ? 'checked' : ''}} id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">Hot Deals</label>
                        </div>
                    
                      </div>
                        <div class="col-md-6">
                       
                          <div class="form-check">
                              <input class="form-check-input" name="featured" type="checkbox" value="1" {{ $product->featured ==1 ? 'checked' : ''}} id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">Featured</label>
                          </div>
                      
                      </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                       
                          <div class="form-check">
                              <input class="form-check-input" name="special_offer" type="checkbox" value="1" {{ $product->special_offer ==1 ? 'checked' : ''}} id="flexCheckDefault">
                              <label class="form-check-label" for="flexCheckDefault">Special Offer</label>
                          </div>
                      
                        </div>
                          <div class="col-md-6">
                         
                            <div class="form-check">
                                <input class="form-check-input" name="special_deals" type="checkbox" value="1" {{ $product->special_deals ==1 ? 'checked' : ''}} id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Special Deals</label>
                            </div>
                        
                        </div>
                      </div>
                      <hr>
                      <div class="col-12">
                          <div class="d-grid">
                             <button type="submit" class="btn btn-primary">Save Product</button>
                          </div>
                      </div>
                  </div> 
              </div>
              </div>
           </div><!--end row-->
        </div>
        </form>
      </div>
  </div>







    <h6 class="mb-0 text-uppercase" >Update Main Image Thambnail</h6>
    <hr>
    <div class="card">
        <form action="{{ route('vendor.update.product.thambnail',$product->id)}}" method="post" id="myForm" enctype="multipart/form-data" >
            @csrf
        <div class="card-body">

            <div class="mb-3">
                <label for="formFile" class="form-label">Chose Thambnail Image</label>
                <input class="form-control" name="product_thambnail" type="file" id="formFile">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label"></label>
                <img src="{{ asset($product->product_thambnail) }}" alt="" style="width: 100px; height:100px;">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>

        </div>
        </form>
    </div>

    <h6 class="mb-0 text-uppercase" >Update Muthi Image</h6>
    <hr>
    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Image</th>
                        <th scope="col">Change Image</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('vendor.update.product.multiimage')}}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        @foreach ($multiImages as $key =>$item)
                        <tr>
                            <th scope="row">{{$key+1 }}</th>
                            <td><img src="{{ asset($item->photo_name)}}" alt="" style="width:70px; height:40px;" ></td>
                            <td><input type="file" class="form-group" name="multi_img[{{$item->id}}]"></td>
                            <td>
                                <input type="submit" class="btn btn-primary px.4" value="Update Image"/>
                                <a href="{{ route('vendor.product.multiimage.delete',$item->id)}}" class="btn btn-danger" id="delete" > Delete</a>
                            </td>
                        </tr>
                            
                        @endforeach
                       
                    </form>
                </tbody>
            </table>
        </div>
    </div>



</div>

<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                product_name: {
                    required : true,
                }, 
                short_descp: {
                    required : true,
                },
                long_descp: {
                    required : true,
                },
                product_thambnail: {
                    required : true,
                },
                selling_price: {
                    required : true,
                },
              
                product_code: {
                    required : true,
                },
                brand_id: {
                    required : true,
                },
                product_qty: {
                    required : true,
                },
                category_id: {
                    required : true,
                },
                subcategory_id: {
                    required : true,
                },
                multi_image: {
                    required : true,
                },
                vendor_id: {
                    required : true,
                },
                product_color: {
                    required : true,
                },
                product_size: {
                    required : true,
                },
                product_tag: {
                    required : true,
                },
            },
            messages :{
                product_name: {
                    required : 'Please Enter Product Name',
                },
                short_desc: {
                    required : 'Please Enter Short Description',
                },
                long_descp: {
                    required : 'Please Enter Long Description',
                },
                product_thambnail: {
                    required : 'Please Select Product Thambnail Image',
                },
                selling_price: {
                    required : 'Please Enter Selling Price',
                },
               
                product_code: {
                    required : 'Please Enter Product Code',
                },
                multi_image: {
                    required : 'Please Select Multi Image ',
                },
                subcategory_id: {
                    required : 'Please Enter Please Enter Subcategory',
                },
                category_id: {
                    required : 'Please Enter Please Enter Category',
                },
                product_qty: {
                    required : 'Please Enter Product Product Quantity',
                },
                brand_id: {
                    required : 'Please Enter Brand Name',
                },
                vendor_id: {
                    required : 'Please Enter Vendor Name',
                },
                product_color: {
                    required : 'Please Enter Product Color',
                },
                product_tag: {
                    required : 'Please Enter Product Tag',
                },
                product_size: {
                    required : 'Please Enter Product Size',
                },
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>

<script type="text/javascript">

function  mailThumUrl(input){
    if(input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function(e){
            $('#mailThumb').attr('src',e.target.result).width(80).height(80);
        };
        reader.readAsDataURL(input.files[0]);
    }


}

$(document).ready(function(){
     $('#multiImage').on('change', function(){ 
        if (window.File && window.FileReader && window.FileList && window.Blob) 
        {
            var data = $(this)[0].files; 
             
            $.each(data, function(index, file){ 
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ 
                    var fRead = new FileReader();
                    fRead.onload = (function(file){ 
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); 
                        $('#preview_img').append(img); 
                    };
                    })(file);
                    fRead.readAsDataURL(file); 
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); 
        }
     });
    });
     
</script>



{{-- <script type="text/javascript">

$(document).ready(function()){
    $('select[name="category_id"]').on(change,function(){
        var category_id = $(this).val();
        if(category_id){
            url:"{{url('/subcategory/ajax')}}/"+category_id,
            type :"get",
            datatype:"json",
            success::function(data){
                $('select[name="subcategory_id"]').html('');
                var d=$('select[name="subcategory_id"]').empty();
                $.each(data,function(key,value){
                    $('select[name="subcategory_id"]').append('<option value="[name="subcategory_id"]"</option>')
                })
            }
        }
    })
}

</script> --}}


@endsection
