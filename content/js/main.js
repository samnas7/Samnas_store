
$(document).ready(function(){
   var action="";
   var size=screen.height;
    $("#toggle-butn").click(function(e){
            e.preventDefault();
            $("#wrapper").toggleClass("menu-display");
            //alert();
            $('#sidebar-wrapper').height(size+500);
            /*
            $("#sidebar-wrapper").css("height", size+150);*/
    });
/**/
    $("#collapse-sidebar").click(function(e){
        e.preventDefault();
        $(".fa-play-circle").toggleClass("fa-rotate-180");
        $(".menu-name").toggle(100);
        $("#sidebar-wrapper").toggleClass("shrink-width");
        $("#content-wrapper").toggleClass("shrink-padding");
    });
    

   cat();
   brands();
   product();
   cart_checkout();
    /*for category */
function cat(){
    $.ajax({
       url: "content/pages/action.php",
        method: "POST",
        data :  {category:1},
        success: function(data){
            $("#get_category").html(data);
        }
    });
}

    /*for brand */
function brands(){
    $.ajax({
       url: "content/pages/action.php",
        method: "POST",
        data: {brands:1},
        success: function(data){
            $("#get_brand").html(data);
        },
        fail: function(data){
            alert("error"+data);
        }
    });
}
/*for product  */  
function product(){
    $.ajax({
       url: "content/pages/action.php",
        method: "POST",
        data: {getProduct:1},
        success: function(data){
            $("#get_product").html(data);
        },
        fail: function(data){
            $("#errorM").html("error"+data);
        }
    });
}
    /*for selecting a category*/
    $("body").delegate(".category","click", function(event){
      event.preventDefault();
      var cat_id=$(this).attr('cat_id');
          $.ajax({
           url: "content/pages/action.php",
            method: "POST",
            data: {get_selected_category:1,cat_id:cat_id},
            success: function(data){
                $("#get_product").html(data);
            },
            fail: function(data){
                alert("error"+data);
            }
        });       
    });
    /*for selecting a brand */
     $("body").delegate(".brand","click", function(event){
      event.preventDefault();
      var brand_id=$(this).attr('brand_id');
          $.ajax({
           url: "content/pages/action.php",
            method: "POST",
            data: {get_selected_brand:1,brand_id:brand_id},
            success: function(data){
                $("#get_product").html(data);
            },
            fail: function(data){
                alert("error"+data);
            }
        });       
    });
    /*for search */
     $("#search_btn").click(function(){
         var keyword = $("#search").val();
         if(keyword != ""){
             $.ajax({
                url:    "content/pages/action.php",
                method: "POST",
                data: {search:1, keyword:keyword},
                success: function(data){
                    $("#get_product").html(data);
                },
                fail: function(data){
                    alert("error"+data);
                }
            }); 
         }
     });
    /*for sign up */
     $("#signup").click(function(event){
         event.preventDefault();
         $.ajax({
            url     : "../pages/register.php",
            method  : "POST",
            data    : $("form").serialize(),
            success : function(data){
                        $("#sign_msg").html(data);  
                        if(data.includes("class='alert alert-success'"))
                            console.log(data, data.includes("class='alert alert-success'"));
                      },
            fail    : function(data){
                        alert("error"+data);
                      }
         });
     });
     /*for login*/
     $("#login").click(function(event){
        event.preventDefault();
        var pass=$("#userpassword").val();
        var email=$("#useremail").val();
        $.ajax({
            url     :   "content/pages/login.php",
            method  :   "POST",
            data    :   {userLogin:1,userEmail:email,userPassword:pass},
            success :   function(data){
                $("#errorM").html(data);
                if(data==1){
                    location.reload();
                }
            }
        });
     });

     /*adding to cart */
     $("body").delegate("#addProduct","click",function(event){
        event.preventDefault();
        var product_id=$(this).attr('product_id');
        $.ajax({
            url     : "content/pages/action.php",
            method  : "POST",
            data    : {addProduct:1,product_id:product_id},
            success : function(data){
                $("#showProduct").html(data);
                cart_count();
            },
            fail    : function(data){
                alert(data);
            }
        });
     });
    cart_count();
     $("body").delegate("#cart-container","click",function(event){
        event.preventDefault();
        $.ajax({
            url     : "content/pages/action.php",
            method  :"POST",
            data    :{get_cart_product:1},
            success :function(data){
                $("#cart-product").html(data);
                /*count cart*/
                cart_count();
            },
            fail :function(data){
                alert(data);
            }
        });
     });

     cart_checkout();
     function cart_checkout(){
        $.ajax({
            url: "../pages/action.php",
            method: "POST",
            data: {cart_checkout:1},
            success: function(data){
                $("#cart_checkout").html(data);
            },
            fail: function(data){
                $("#errorM").html(data);
            }
        });
    }
        function getConfirmation(event,  sam) {
            var Confirmation = confirm(sam);
            if (Confirmation){
               
               event.preventDefault();
               return true;
            } else{
               
               event.preventDefault(); 
               return false;
            }            
        }
    $("body").delegate("#delete","click",function(event){
        var sam="do you want to delete this?";
        if(getConfirmation(event,sam)){
            event.preventDefault();
            var cart_id=$(this).attr('cart_id');
            $.ajax({
                url     : "../pages/action.php",
                method  : "POST",
                data    : {deleteCart:1,cart_id:cart_id},
                success : function(data){
                     $("#errorM").html(data);
                     cart_checkout();
                },
                fail    : function(data){
                    $("#errorM").html(data);
                }
            });
        }
        
        
    });
    /* data-target="#myModal" data-toggle="modal"*/
    $("body").delegate("#info","click",function(event){ 
        event.preventDefault();
        var cart_id=$(this).attr('cart_id');
        var p_id=$(this).attr('p_id');
        
        $.ajax({
                url     : "../pages/action.php",
                method  : "POST",
                data    : {cartInfo:1,cart_id:cart_id,p_id:p_id},
                success : function(data){
                     $("#modal-body").html(data);
                },
                fail    : function(data){
                    $("#errorM").html(data);
                }
            });
    });

    $("body").delegate(".qty","keyup",function(event){ 
    //event.preventDefault();
    var p_id=$(this).attr("p_id");
    var qty=$("#qty-"+p_id).val();
    var price=$("#price-"+p_id).val();
    var total=qty*price;
    $("#total-"+p_id).val(total);
    
    }); 

      $("body").delegate("#adding","click",function(event){ 
        event.preventDefault();
        var cart_id=$(this).attr("cart_id");
        var p_id=$(this).attr("p_id");
        var qty=$("#qty-"+p_id).val();
        var total=$("#total-"+p_id).val();
        $.ajax({
                url     : "../pages/action.php",
                method  : "POST",
                data    : {cartAdding:1,cart_id:cart_id,p_id:p_id,qty:qty,total:total},
                success : function(data){
                   $("#errorM").html(data);
                   cart_checkout();
                },
                fail    : function(data){
                    $("#errorM").html(data);
                }
        });
    });
    page();
    function page(){
        $.ajax({
            url     : "content/pages/action.php",
                method  : "POST",
                data    : {page:1},
                success : function(data){
                   $("#pageNo").html(data);
                },
                fail    : function(data){
                    $("#errorM").html(data);
                }
                
        });
    }
    $("body").delegate("#pageLink","click",function(event){
        var pn=$(this).attr("page");
        $.ajax({
                url     : "content/pages/action.php",
                    method  : "POST",
                    data    : {getProduct:1,setPage:1,pageNum:pn},
                    success : function(data){
                    $("#get_product").html(data);
                    },
                    fail    : function(data){
                        $("#errorM").html(data);
                    }
        });
    });
  cart_container();
    function cart_container(){
         $.ajax({
            url     : "content/pages/action.php",
            method  :"POST",
            data    :{get_cart_product:1},
            success :function(data){
                $("#cart-product").html(data);
                  cart_count();
            },
            fail :function(data){
                alert(data);
            }
        });
      
    }
    
    function cart_count(){
        $.ajax({
                url     : "content/pages/action.php",
                method  : "POST",
                data    : {cart_count:1},
                success : function(data){
                   $(".badge").html(data);
                }
        });
    } 
     $("body").delegate("#shp","click",function(event){
     	$('input.password').attr('type',$(this).is(':checked') ? 'text' : 'password');
     	$('.lock').attr('class',$(this).is(':checked') ? 'fa fa-unlock-alt fa-2x lock' : 'fa fa-lock fa-2x lock');
     	$('#txtshp').text($(this).is(':checked') ? 'Hide Password' : 'Show Password');
     });
	$("body").delegate("#admin_login","click",function(event){
		event.preventDefault();
        var password=$("#password").val();
        var admin_name=$("#admin_name").val();
		$.ajax({
			url     : "../pages/login.php",
			method  : "POST",
			data    :   {admin_login:1,admin_name:admin_name,password:password},
			success : function(data){
			   if(data==1){
                    window.location.assign('admin.php');
                }else{
                    $(".message").html(data);
                }
			}
		});
     }); 
	 $("body").delegate("#change_password","click",function(event){
		event.preventDefault();
		$(".message").html("");
        var admin_id=$("#admin_id").val();
        var old_password=$("#old_password").val();
        var new_password=$("#new_password").val();
        var confirm_new_password=$("#confirm_new_password").val();
		if(old_password==""){
			$(".message").html(mess("Please input your current password"));
		}else if(new_password==""){
			$(".message").append(mess("Please input a new password"));
		}else if(confirm_new_password==""){
			$(".message").append(mess("Please confirm your new password"));
		}else if(new_password!==confirm_new_password){
			$(".message").append(mess("New password and confirm new password are not the same"));
		}else{
			$.ajax({
				url     : "updates.php",
				method  : "POST",
				data    :   {change_password:1,old_password:old_password,new_password:new_password,confirm_new_password:confirm_new_password,admin_id:admin_id},
				success : function(data){
					
				$(".message").append(data);
				   /* if(data==1){
						window.location.assign('admin.php');
					}else{
						$(".message").html(data);
					} */
				}
			});
		}
	 });
	 function mess(message){
		 return " <div class='alert alert-danger'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>"+message+"</b></div>"
	 }
     /*admin*/
     var actions="";
     showUser(actions);
     function showUser(actions){
        $.ajax({
           url: "updates.php",
            method: "POST",
            data :  {usersInfomation:1},
            success: function(data){
                $("#user_table").html(data);
                actions;
            }
        });
    }
    admin_page();
    function admin_page(){
        $.ajax({
            url     : "updates.php",
                method  : "POST",
                data    : {admin_page:1},
                success : function(data){
                   $("#userPageNo").html(data);
                },
                fail    : function(data){
                    $("#message").html(data);
                }
                
        });
    }/**/

    $("body").delegate("#adminPageLink","click",function(event){
        event.preventDefault();
        var page_id=$(this).attr("userPage");
        
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{usersInfomation:1,setAdminPage:1,page_id:page_id},
            success : function(data){
                   $("#user_table").html(data);

                },
            fail    : function(data){
                    $("#message").html(data);
                }
        });

     });

    $("body").delegate(".user_status","click",function(event){
        event.preventDefault();
        var user_id=$(this).attr("user_id");
        var status=$(this).attr("status");
        $.ajax({
           url: "updates.php",
            method: "POST",
            data :  {block:1,user_id:user_id,status:status},
            success: function(data){
               
                var actions=window.location.assign('admin.php');
                showUser(actions);
                 $("#message").html(data);
            }
        });
        
    });
    /*for brands*/
    show_brand(actions);
    function show_brand(actions){
        $.ajax({
            url     : "updates.php",
            method  :"POST",
            data    :{brandInformation:1},
            success :function(data){
                $("#brand_table").html(data);
                actions;
            },
            fail    :function(data){
                $("#message").html(data);
            }
        });
    }
    brand_page();
    function brand_page(){
        $.ajax({
            url: "updates.php",
            method:"POST",
            data:{brand_page:1},
            success:function(data){
                $("#brandPageNo").html(data);
            },
            fail:function(data){
                $("#message").html(data);
            }
        });
    }

    $("body").delegate("#brandPageLink","click",function(event){
        event.preventDefault();
        var brandNo=$(this).attr("brand");
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{brandInformation:1,setBrandPage:1,page_id:brandNo},
            success : function(data){
                   $("#brand_table").html(data);
                },
            fail    : function(data){
                    $("#message").html(data);
                }
        });
    });

    $("body").delegate("#edit_brand","click",function(event){
        event.preventDefault();
        var brand_id=$(this).attr("brand_id");
        var brand_title=$(this).attr("brand_title");
         $("#message").html("<div class='alert alert-success' style='margin-bottom: 50px;'><a href='#' class='close'data-dismiss='alert' aria-label='close'>&times;</a><div class='row' style='background-color: transparent; height: 34px;'><div class='col-md-3'><input type='hidden' class='form-control' value='"+brand_id +"' id='brand_id' name='id'></div><div class='col-md-3'><input type='text' class='form-control' value='"+brand_title+"' id='title' name='title'></div><div class='col-md-3'><input type='submit' class='btn btn-success' id='edit' value='Edit'></div></div>   </div>");
    });
    $("body").delegate("#edit","click",function(event){
        event.preventDefault();
        var brand_id=$("#brand_id").val();
        var brand_title=$("#title").val();
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{edit:1,brand_title:brand_title,brand_id:brand_id},
            success:function(data){
                $("#message").html(data);
                var actions=window.location.assign('show_brand.php');
                show_brand(actions);
            },
            fail:function(data){
                $("#message").html(data);
            }
        });        
    });

    /*for categories*/
    show_category(actions);
    function show_category(actions) {
        $.ajax({
            url     :"updates.php",
            method  :"POST",
            data    :{cartegoryInfomation:1},
            success :function(data) {
                $("#category_table").html(data);
                actions;
            },
            fail    :function(data){
                $("#message").html(data);
            }
        });
    }

    category_page();
    function category_page(){
        $.ajax({
            url     : "updates.php",
            method  :"POST",
            data    : {categories_page:1},
            success :function(data){
                $("#categoryPageNo").html(data);
            },
            fail:function(data){
                $("#message").html(data);
            }
        });
    }
    $("body").delegate("#catPageLink","click",function(event){
        event.preventDefault();
        var cat_id=$(this).attr("cat");
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{cartegoryInfomation:1,setCatPage:1,cat_no:cat_id},
            success : function(data){
                   $("#category_table").html(data);
                },
            fail    : function(data){
                    $("#message").html(data);
                }
        });
    });
    $("body").delegate("#edit_cat","click",function(event){
        event.preventDefault();
        var cat_id=$(this).attr("cat_id");
        var cat_title=$(this).attr("cat_title");
         $("#message").html("<div class='alert alert-success' style='margin-bottom: 50px;'><a href='#' class='close'data-dismiss='alert' aria-label='close'>&times;</a><div class='row' style='background-color: transparent; height: 34px;'><div class='col-md-3'><input type='hidden' class='form-control' value='"+cat_id +"' id='cat_id' name='id'></div><div class='col-md-3'><input type='text' class='form-control' value='"+cat_title+"' id='title' name='title'></div><div class='col-md-3'><input type='submit' class='btn btn-success' id='cat_edit' value='Edit'></div></div>   </div>");
    });
    $("body").delegate("#cat_edit","click",function(event){
        event.preventDefault();
        var cat_id=$("#cat_id").val();
        var cat_title=$("#title").val();
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{cat_edit:1,cat_title:cat_title,cat_id:cat_id},
            success:function(data){
                $("#message").html(data);
                var actions=window.location.assign('show_category.php');
                show_brand(actions);
            },
            fail:function(data){
                $("#message").html(data);
            }
        });        
    });  
      /*for products*/
    show_products(actions);
    function show_products(actions) {
        $.ajax({
            url     :"updates.php",
            method  :"POST",
            data    :{productsInfomation:1},
            success :function(data) {
                $("#products_table").html(data);
                actions;
            },
            fail    :function(data){
                $("#message").html(data);
            }
        });
    }

    product_list();
    function product_list(){

        $("ul#pagination_products_page_no").html("<li><a href='#' products_id='1' id='productPageLink'>1</a></li>");
       /* $.ajax({
            url     : "updates.php",
            method  : "POST",
            data    :{products_page:1},
            success :function(data){
                $("#pagination_products_page_no").html(data);
            },
            fail:function(data){
                $("#message").html(data);
            }
        });*/

    }

    $("body").delegate("#productPageLink","click",function(event){
        event.preventDefault();
        var products_id=$(this).attr("products_id");
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{productsInfomation:1,setProductsPage:1,products_id:products_id},
            success : function(data){
                   $("#products_table").html(data);
                },
            fail    : function(data){
                    $("#message").html(data);
                }
        });
    });
    $("body").delegate("#view_product","click",function(event){
        var product_id=$(this).attr("product_id");
        var product_title=$(this).attr("product_title");
        var product_image=$(this).attr("product_image");
        var product_price=$(this).attr("product_price");
        var product_keywords=$(this).attr("product_keywords");
        var product_desc=$(this).attr("product_desc");
        var product_brand=$(this).attr("product_brand");
        var product_cat=$(this).attr("product_cat");
        
        //$("#").html(product_image);
        $.ajax({
            url:"updates.php",
            method:"POST",
            data:{display_products:1, product_id:product_id,product_title:product_title,product_image:product_image,product_price:product_price,product_keywords:product_keywords,product_desc:product_desc,product_brand:product_brand,product_cat:product_cat},
            success :function (data){
                $("#inside_modal_body").html(data);
            },
            fail: function(data){
                $("#message").html(data);
            }
        });
    });/*edit*/

     $("body").delegate("#edit_product","click",function(event){
        /*event.preventDefault();
        $("#edit_product").attr("data_target":"#myModal", "data-toggle":"modal");*/
        var product_id=$(this).attr("product_id");
        var product_title=$(this).attr("product_title");
        var product_image=$(this).attr("product_image");
        var product_price=$(this).attr("product_price");
        var product_keywords=$(this).attr("product_keywords");
        var product_desc=$(this).attr("product_desc");
        var product_brand=$(this).attr("product_brand");
        var product_cat=$(this).attr("product_cat");
       /*$(".modal-body").html("<p>"+product_id+" "+product_title+" "+product_image+" "+product_title+"</p>");*/
       $.ajax({
        url     :"updates.php",
        method  :"POST",
        data    :{edit_this_product:1,product_id:product_id,product_title:product_title,product_image:product_image,product_price:product_price,product_keywords:product_keywords,product_desc:product_desc,product_brand:product_brand,product_cat:product_cat},
        success :function(data) {
            $("#inside_modal_body").html(data);
        },
        fail    : function(data){
                $("#message").html(data);
            }
       });
        
    });
    
    $("#submit_edit").click(function(event){
         event.preventDefault();
        $.ajax({
            url     : "add_to_db.php",
            method  : "POST",
            data    : $("form").serialize(),
            success : function(data){
                        $("#message").html(data);
                      },
            fail    : function(data){
                        alert("error"+data);
                      }
         });
     });
     admin_details(actions);
    function admin_details(actions){
        $.ajax({
            url     :"updates.php",
            method  :"POST",
            data    :{adminstrators:1},
            success :function (data){
                $("#admin_table").html(data);
                actions;
            },
            fail    :function(data) {
                $("#message").html(data);
            }
        });
    }
    admin_counts();
    function admin_counts() {
      $.ajax({
        url     :"updates.php",
        method  :"POST",
        data    :{count_admin:1},
        success :function(data) {
            $("#adminPageNo").html(data);
        },
        fail    :function(data) {
                $("#message").html(data);
            }
      });
    }
    $("body").delegate("#adminPageLink","click",function(event){
        event.preventDefault();
        var admin_no=$(this).attr("admin_no");
        /*alert(admin_no);*/
        $.ajax({
            url     :"updates.php",
            method  :"POST",
            data    :{adminstrators:1,set_admin_page:1,adminNo:admin_no},
            success :function(data) {
                $("#admin_table").html(data);
            },
            fail    :function(data){
                $("#message").html(data);
            }
        });
    });
    $("body").delegate("#edit_privillege","click",function(event){
        event.preventDefault();
        var admin_id=$(this).attr("admin_id");
        var privileges=$(this).attr("privileges");
        $.ajax({
            url :"updates.php",
            method :"POST",
            data :{edit_privillege:1,admin_id:admin_id,privileges:privileges},
            success :function(data) {
                $("#message").html(data);
                var actions=window.location.assign('show_admin.php');
                admin_details(actions);
            },
            fail :function(data) {
                $("#message").html(data);
            }
        });
    });
    
    
    $("body").delegate("#add_brand","click",function(event){
        event.preventDefault();
         $("#message").html("<div class='alert alert-success' style='margin-bottom: 50px;'><a href='#' class='close'data-dismiss='alert' aria-label='close'>&times;</a><div class='row' style='background-color: transparent; height: 34px;'><div class='col-md-4'><input class='form-control' placeholder='Brand' type='text' id='set_brand'></div><div class='col-md-4'><a class='btn btn-success form-control' id='addingBrand'>Add Brand</a></div></div></div>");
    });
    $("body").delegate("#addingBrand","click",function(event){
        event.preventDefault();
        var set_brand=$("#set_brand").val();
        if (set_brand=="") {
            alert("field empty");
        } else {
            $.ajax({
                url :"updates.php",
            method :"POST",
            data :{addingBrand:1,set_brand:set_brand},
            success :function(data) {
                alert(data);
                location.reload();
            },
            fail :function(data) {
                $("#message").html(data);
            }
            });
        }
        
    });

    $("body").delegate("#add_category","click",function(event){
        event.preventDefault();
         $("#message").html("<div class='alert alert-success' style='margin-bottom: 50px;'><a href='#' class='close'data-dismiss='alert' aria-label='close'>&times;</a><div class='row' style='background-color: transparent; height: 34px;'><div class='col-md-4'><input class='form-control' placeholder='Category' type='text' id='set_category'></div><div class='col-md-4'><a class='btn btn-success form-control' id='addingCategory'>Add Category</a></div></div></div>");
    });
     $("body").delegate("#addingCategory","click",function(event){
        event.preventDefault();
        var set_category=$("#set_category").val();
        if (set_category=="") {
            alert("field empty");
        } else {
            $.ajax({
                url :"updates.php",
            method :"POST",
            data :{addingCategory:1,set_category:set_category},
            success :function(data) {
                alert(data);
                location.reload();
            },
            fail :function(data) {
                $("#message").html(data);
            }
            });
        }
        
    });
     $("body").delegate("#delete_product","click",function(event){
         
         if (getConfirmation(event,  "do you want to delete this?")) {
            event.preventDefault();
            var product_id=$(this).attr("product_id");

            $.ajax({
                url :"updates.php",
                method :"POST",
                data :{delete_product:1,product_id:product_id},
                success :function(data) {
                    alert(data);
                    location.reload();
                },
                fail :function(data) {
                    $("#message").html(data);
                }
            });
         } else {

         }
     });
     /*add product page*/
     show_add_product();
     function show_add_product(){
         $.ajax({
                url :"updates.php",
                method :"POST",
                data :{show_add_product:1},
                success :function(data) {
                    $("#form_horizontal").html(data);
                },
                fail :function(data) {
                    $("#message").html(data);
                }
            });
     }
    /*add_admin_Info*/
    
     $("body").delegate("#add_admin_Info","click",function(event){
        event.preventDefault();
        $.ajax({
                url :"updates.php",
                method :"POST",
                data :{add:1},
                success :function(data) {
                    $("#adding_admin").html(data);
                },
                fail :function(data) {
                    $("#message").html(data);
                }
        });
        /*$("#message").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>HEllooo</b></div>");*/
     });/*change_admin_Info */
     $("body").delegate("#change_admin_Info","click",function(event){
        event.preventDefault();
        $.ajax({
                url :"updates.php",
                method :"POST",
                data :{change_admin_Info:1},
                success :function(data) {
                    $("#admin_changing").html(data);   
                },
                fail :function(data) {
                    $("#message").html(data);
                }
        });
     });
    $("body").delegate("#changing_password","click",function(event){
        event.preventDefault();
        $.ajax({
                url :"updates.php",
               method :"POST",
                data :{changing_password:1},
                success :function(data) {
                    $("#changing").html(data);   
                },
                fail :function(data) {
                    $("#message").html(data);
                }
        });/* */
     });
     $("body").delegate("#viewProduct","click",function(event){
        event.preventDefault();
        var product_id =$(this).attr("product_id");
        
        $.ajax({
                url :"content/pages/action.php",
               method :"POST",
                data :{viewProduct:1,product_id:product_id},
                success :function(data) {
                    $("#modal-body").html(data);   
                },
                fail :function(data) {
                    $("#errorM").html(data);
                }
        }); 
     });
     
    $("body").delegate("#showing_cart","click",function(event){
        var user_id=$(this).attr("user_id");
        //alert(user_id);
        $.ajax({
                url :"updates.php",
               method :"POST",
                data :{showing_cart:1,user_id:user_id},
                success :function(data) {
                    $("#modal-body").html(data);   
                },
                fail :function(data) {
                    $("#errorM").html(data);
                }
        }); 
    });
    $("body").delegate("#sending_mail","click",function(event){
        var user_id=$(this).attr("user_id");
        var email=$(this).attr("email");
        var firstName=$(this).attr("firstName");
        var lastName=$(this).attr("lastName");
        $.ajax({
                url :"updates.php",
               method :"POST",
                data :{sending_mail:1,user_id:user_id,email:email,firstName:firstName,lastName:lastName},
                success :function(data) {
                    $("#modal-body").html(data);   
                },
                fail :function(data) {
                    $("#errorM").html(data);
                }
        }); 
        //alert(user_id+" "+email+" "+firstName+" "+lastName);
    });

    $("body").delegate("#add_more","click",function(event){
        event.preventDefault();
        var product_id=$(this).attr("product_id");
        
        $.ajax({
            url     :"updates.php",
            method  :"POST",
            data    :{add_more:1,product_id:product_id},
            success :function(data){
                $("#inside_modal_body").html(data);
            },
            fail  :function(data) {
                $("#message").html(data);
            }
        });
    });
    $("body").delegate("#delete_brand","click",function(event){
        var sam="do you want to delete this?";
        var brand_id=$(this).attr("brand_id");

        if(getConfirmation(event,sam)){
            event.preventDefault();           
            $.ajax({
                url:"updates.php",
                method:"POST",
                data:{delete_brand:1,brand_id:brand_id},
                success:function (data) {
                    $("#message").html(data);
                    show_brand(actions);
                }

            });
        }
    });
    $("body").delegate("#delete_cat","click",function(event){
        var sam="do you want to delete this?";
        var cat_id=$(this).attr("cat_id");
        if(getConfirmation(event,sam)){
            event.preventDefault();
            $.ajax({
                url:"updates.php",
                method:"POST",
                data:{delete_cat:1,cat_id:cat_id},
                success:function (data) {
                    $("#message").html(data);
                    show_category(actions);
                }

            });
        }
    });
    $("body").delegate("#deleting_image","click",function(event){
        event.preventDefault();
        var image_id=$(this).attr("image_id");
        var sam="do you want to delete this?";
        
        if(getConfirmation(event,sam)){
            $.ajax({
                url     :"updates.php",
                method  :"POST",
                data    :{deleting_image:1,image_id:image_id},
                success :function(data){
                    $("#message").html(data);
                    location.reload();
                }
            });
        }
    });

});