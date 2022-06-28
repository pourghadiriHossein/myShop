<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\Tool;
use App\Models\User;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Comment;
use App\Models\Region;
use App\Models\City;
use App\Models\Zone;
use App\Models\Address;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use function Symfony\Component\Finder\name;

class AdminController extends Controller
{
    //index
    public function adminIndex()
    {
        return view('admin.index.adminIndex');
    }
    //user
    public function adminVisitUser()
    {
        if (Auth::user()->hasRole('admin'))
            $users = User::all();
        else
        {
            $users = [];
            $users [] = User::find(Auth::user()->id);
        }
        return view('admin.user.adminVisitUser',compact('users'));
    }

    public function adminAddUser()
    {
        $roles = Role::all();
        return view('admin.user.adminAddUser', compact('roles'));
    }

    public function adminPostAddUser(Request $request)
    {
        $newUser = new User();
        $newUser->name = $request->input('name');
        $newUser->phone = $request->input('phone');
        $newUser->email = $request->input('email');
        $newUser->password = Hash::make($request->input('password'));
        $newUser->status = $request->input('status');
        $newUser->save();
        $newUser->syncRoles(Role::findById($request->input('role')));
        return redirect(route('adminVisitUser'));
    }

    public function adminUpdateUser($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.user.adminUpdateUser', compact('user', 'roles'));
    }

    public function adminPostUpdateUser(Request $request,$userId)
    {
        $updateUser = User::find($userId);
        if ($request->input('name')!=null)
            $updateUser->name = $request->input('name');
        if ($request->input('phone')!=null)
            $updateUser->phone = $request->input('phone');
        if ($request->input('email')!=null)
            $updateUser->email = $request->input('email');
        if ($request->input('password')!=null)
            $updateUser->password = Hash::make($request->input('password'));
        if ($request->input('status')!=null)
            $updateUser->status = $request->input('status');
        $updateUser->save();
        if ($request->input('role')!=null)
            $updateUser->syncRoles(Role::findById($request->input('role')));
        return redirect(route('adminVisitUser'));
    }
    //permission
    public function adminVisitPermission()
    {
        $permissions = Permission::all();
        return view('admin.permission.adminVisitPermission',compact('permissions'));
    }

    public function adminAddPermission()
    {
        return view('admin.permission.adminAddPermission');
    }

    public function adminUpdatePermission($permissionId)
    {
        $permission = Permission::find($permissionId);
        return view('admin.permission.adminUpdatePermission', compact('permission'));
    }

    public function adminPostAddPermission(Request $request)
    {
        $newPermission = new Permission();
        $newPermission->name = $request->input('name');
        $newPermission->guard_name = $request->input('guard_name');
        $newPermission->save();
        return redirect(route('adminVisitPermission'));
    }

    public function adminPostUpdatePermission(Request $request,$permissionId)
    {
        $updatePermission = Permission::find($permissionId);
        $updatePermission->name = $request->input('name');
        $updatePermission->guard_name = $request->input('guard_name');
        $updatePermission->save();
        return redirect(route('adminVisitPermission'));
    }

    public function adminDeletePermission($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect(route('adminVisitPermission'));
    }
    //role
    public function adminVisitRole()
    {
        $roles = Role::all();
        return view('admin.role.adminVisitRole',compact('roles'));
    }

    public function adminAddRole()
    {
        $permissions = Permission::all();
        return view('admin.role.adminAddRole', compact('permissions'));
    }

    public function adminUpdateRole($roleId)
    {
        $role = Role::find($roleId);
        $selectedPermission = $role->permissions()->pluck('name')->toArray();
        $permissions = Permission::all();
        return view('admin.role.adminUpdateRole',compact('permissions','role','selectedPermission'));
    }
    public function adminPostAddRole(Request $request)
    {
        $permissions = $request->input('permissions');
        $newRole = new Role();
        $newRole->name = $request->input('name');
        $newRole->guard_name = $request->input('guard_name');
        $newRole->save();
        $newRole->permissions()->sync($permissions);
        return redirect(route('adminVisitRole'));
    }

    public function adminPostUpdateRole(Request $request,$roleId)
    {
        $permissions = $request->input('permissions');
        $updateRole = Role::find($roleId);
        $updateRole->name = $request->input('name');
        $updateRole->guard_name = $request->input('guard_name');
        $updateRole->save();
        $updateRole->Permissions()->sync($permissions);
        return redirect(route('adminVisitRole'));
    }

    public function adminDeleteRole($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect(route('adminVisitRole'));
    }
    //category
    public function adminVisitCategory()
    {
        $categories = Category::all();
        return view('admin.category.adminVisitCategory',compact('categories'));
    }

    public function adminAddCategory()
    {
        return view('admin.category.adminAddCategory');
    }

    public function adminAddParentCategory($parent_id)
    {
        $parent = Category::find($parent_id);
        return view('admin.category.adminAddParentCategory',compact('parent'));
    }

    public function adminUpdateCategory($categoryId)
    {
        $allCategory = Category::all();
        $selectedCategory = Category::find($categoryId);
        return view('admin.category.adminUpdateCategory', compact('allCategory','selectedCategory'));
    }
    public function adminPostAddCategory(Request $request)
    {
        $newCategory = new Category();
        $newCategory->label = $request->input('label');
        $newCategory->status = $request->input('status');
        $newCategory->save();
        return redirect(route('adminVisitCategory'));
    }
    public function adminPostAddParentCategory(Request $request,$categoryId)
    {
        $newParentCategory = new Category();
        $newParentCategory->parent_id = $categoryId;
        $newParentCategory->label = $request->input('label');
        $newParentCategory->status = $request->input('status');
        $newParentCategory->save();
        return redirect(route('adminVisitCategory'));
    }
    public function adminPostUpdateCategory(Request $request,$categoryId)
    {
        $updateCategory = Category::find($categoryId);
        $updateCategory->parent_id = $request->input('parent_id');
        $updateCategory->label = $request->input('label');
        $updateCategory->status = $request->input('status');
        $updateCategory->save();
        return redirect(route('adminVisitCategory'));
    }
    //tag
    public function adminVisitTag()
    {
        $tags = Tag::all();
        return view('admin.tag.adminVisitTag',compact('tags'));
    }

    public function adminAddTag()
    {
        return view('admin.tag.adminAddTag');
    }

    public function adminUpdateTag($tagId)
    {
        $tag = Tag::find($tagId);
        return view('admin.tag.adminUpdateTag',compact('tag'));
    }
    public function adminPostAddTag(Request $request)
    {
        $newTag = new Tag();
        $newTag->label = $request->input('label');
        $newTag->status = $request->input('status');
        $newTag->save();
        return redirect(route('adminVisitTag'));
    }
    public function adminPostUpdateTag(Request $request,$tagId)
    {
        $updateTag = Tag::find($tagId);
        $updateTag->label = $request->input('label');
        $updateTag->status = $request->input('status');
        $updateTag->save();
        return redirect(route('adminVisitTag'));
    }
    //discount
    public function adminVisitDiscount()
    {
        $discounts = Discount::all();
        return view('admin.discount.adminVisitDiscount',compact('discounts'));
    }
    public function adminAddDiscount()
    {
        return view('admin.discount.adminAddDiscount');
    }
    public function adminUpdateDiscount($discountId)
    {
        $discount = Discount::find($discountId);
        return view('admin.discount.adminUpdateDiscount',compact('discount'));
    }
    public function adminPostAddDiscount(Request $request)
    {
        $newDiscount = new Discount();
        $newDiscount->label = $request->input('label');
        $newDiscount->price = $request->input('price');
        $newDiscount->percent = $request->input('percent');
        $newDiscount->token = $request->input('token');
        $newDiscount->status = $request->input('status');
        $newDiscount->save();
        return redirect(route('adminVisitDiscount'));
    }
    public function adminPostUpdateDiscount(Request $request,$discountId)
    {
        $updateDiscount = Discount::find($discountId);
        $updateDiscount->label = $request->input('label');
        $updateDiscount->price = $request->input('price');
        $updateDiscount->percent = $request->input('percent');
        $updateDiscount->token = $request->input('token');
        $updateDiscount->status = $request->input('status');
        $updateDiscount->save();
        return redirect(route('adminVisitDiscount'));
    }
    //product
    public function adminVisitProduct()
    {
        $products = Product::all();
        return view('admin.product.adminVisitProduct',compact('products'));
    }
    public function adminAddProduct()
    {
        $tags = Tag::all();
        $discounts = Discount::all();
        $categories = Category::all();
        return view('admin.product.adminAddProduct', compact('discounts','tags','categories'));
    }
    public function adminUpdateProduct($productID)
    {
        $tags = Tag::all();
        $discounts = Discount::all();
        $categories = Category::all();
        $product = Product::find($productID);
        $selectedTag = $product->tags->pluck('label')->toArray();
        return view('admin.product.adminUpdateProduct',compact('discounts','tags','categories','product','selectedTag'));
    }
    public function adminPostAddProduct(Request $request)
    {
        $newProduct = new Product();
        $newProduct->discount_id = $request->input('discount_id');
        $newProduct->category_id = $request->input('category_id');
        $newProduct->label = $request->input('label');
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->status = $request->input('status');
        $newProduct->save();
        $newProduct->tags()->sync($request->input('tags'));
        $paths = [];
        foreach ($request->file('images') as $image)
        {
            $paths[] = $image->storePubliclyAs(Tool::imagePath(),'image'.time().rand(1,10000).'.'.$image->extension());
        }
        foreach ($paths as $path)
        {
            $newProductImage = new ProductImage();
            $newProductImage->product_id = $newProduct->id;
            $newProductImage->path = str_replace('public', 'storage', $path);
            $newProductImage->save();
        }
        return redirect(route('adminVisitProduct'));
    }
    public function adminPostUpdateProduct(Request $request,$productId)
    {

        $updateProduct = Product::find($productId);
        $updateProduct->discount_id = $request->input('discount_id');
        $updateProduct->category_id = $request->input('category_id');
        $updateProduct->label = $request->input('label');
        $updateProduct->description = $request->input('description');
        $updateProduct->price = $request->input('price');
        $updateProduct->status = $request->input('status');
        $updateProduct->save();
        $updateProduct->tags()->sync($request->input('tags'));
        if ($request->hasFile('images'))
        {
            $paths = [];
            foreach ($request->file('images') as $image)
            {
                $paths[] = $image->storePubliclyAs(Tool::imagePath(),'image'.time().rand(1,10000).'.'.$image->extension());
            }
            foreach ($paths as $path)
            {
                $newProductImage = new ProductImage();
                $newProductImage->product_id = $updateProduct->id;
                $newProductImage->path = str_replace('public', 'storage', $path);
                $newProductImage->save();
            }
        }
        return redirect(route('adminVisitProduct'));
    }

    public function adminDeleteProductImage($imageID)
    {
        $image = ProductImage::find($imageID);
        File::delete($image->path);
        $image->delete();
        return redirect(route('adminVisitProduct'));
    }
    //comment
    public function adminVisitComment()
    {
        if (Auth::user()->hasRole('admin'))
            $comments = Comment::all();
        else
            $comments = Comment::where('user_id',Auth::user()->id)->get();
        return view('admin.comment.adminVisitComment',compact('comments'));
    }
    public function adminUpdateComment($commentID)
    {
        $comment = Comment::find($commentID);
        return view('admin.comment.adminUpdateComment', compact('comment'));
    }
    public function adminPostUpdateComment(Request $request,$commentID)
    {
        $updateComment = Comment::find($commentID);
        $updateComment->description = $request->input('description');
        $updateComment->status = $request->input('status');
        $updateComment->save();
        return redirect(route('adminVisitComment'));
    }
    //region & city & zone
    //region
    public function adminVisitRegion()
    {
        $regions = Region::all();
        return view('admin.RCZ.adminVisitRegion',compact('regions'));
    }
    public function adminAddRegion()
    {
        return view('admin.RCZ.adminAddRegion');
    }
    public function adminUpdateRegion($regionID)
    {
        $region = Region::find($regionID);
        return view('admin.RCZ.adminUpdateRegion',compact('region'));
    }
    public function adminPostAddRegion(Request $request)
    {
        $newRegion = new Region();
        $newRegion->label = $request->input('label');
        $newRegion->status = $request->input('status');
        $newRegion->save();
        return redirect(route('adminVisitRegion'));
    }
    public function adminPostupdateRegion(Request $request,$regionID)
    {
        $updateRegion = Region::find($regionID);
        $updateRegion->label = $request->input('label');
        $updateRegion->status = $request->input('status');
        $updateRegion->save();
        return redirect(route('adminVisitRegion'));
    }
    //city
    public function adminVisitCity()
    {
        $cities = City::all();
        return view('admin.RCZ.adminVisitCity',compact('cities'));
    }
    public function adminAddCity($regionID)
    {
        return view('admin.RCZ.adminAddCity',compact('regionID'));
    }
    public function adminUpdateCity($cityID)
    {
        $city = City::find($cityID);
        return view('admin.RCZ.adminUpdateCity',compact('city'));
    }
    public function adminPostAddCity(Request $request,$cityID)
    {
        $newCity = new City();
        $newCity->label = $request->input('label');
        $newCity->status = $request->input('status');
        $newCity->region_id = $cityID;
        $newCity->save();
        return redirect(route('adminVisitCity'));
    }
    public function adminPostUpdateCity(Request $request,$cityID)
    {
        $updateCity = City::find($cityID);
        $updateCity->label = $request->input('label');
        $updateCity->status = $request->input('status');
        $updateCity->save();
        return redirect(route('adminVisitCity'));
    }
    //zone
    public function adminVisitZone()
    {
        $zones = Zone::all();
        return view('admin.RCZ.adminVisitZone',compact('zones'));
    }
    public function adminAddZone($cityID)
    {
        return view('admin.RCZ.adminAddZone',compact('cityID'));
    }
    public function adminUpdateZone($zoneID)
    {
        $zone = Zone::find($zoneID);
        return view('admin.RCZ.adminUpdateZone',compact('zone'));
    }
    public function adminPostAddZone(Request $request,$cityID)
    {
        $newZone = new Zone();
        $newZone->label = $request->input('label');
        $newZone->status = $request->input('status');
        $newZone->city_id = $cityID;
        $newZone->save();
        return redirect(route('adminVisitZone'));
    }
    public function adminPostUpdateZone(Request $request,$zoneID)
    {
        $updateZone = Zone::find($zoneID);
        $updateZone->label = $request->input('label');
        $updateZone->status = $request->input('status');
        $updateZone->save();
        return redirect(route('adminVisitZone'));
    }
    //address
    public function adminVisitAddress()
    {
        if (Auth::user()->hasRole('admin'))
            $addresses = Address::all();
        else
            $addresses = Address::where('user_id',Auth::user()->id)->get();
        return view('admin.address.adminVisitAddress',compact('addresses'));
    }
    public function adminDeleteAddress($addressID)
    {
        $address = Address::find($addressID);
        $address->delete();
        return redirect(route('adminVisitAddress'));
    }
    //order
    public function adminVisitOrder()
    {
        if (Auth::user()->hasRole('admin'))
            $orders = Order::all();
        else
            $orders = Order::where('user_id',Auth::user()->id)->get();
        return view('admin.order.adminVisitOrder',compact('orders'));
    }
    //transaction
    public function adminVisitTransaction()
    {
        if (Auth::user()->hasRole('admin'))
            $transactions = Transaction::all();
        else
        {
            $orders = Order::where('user_id',Auth::user()->id)->pluck('id');
            if (!empty($orders))
                $transactions = Transaction::whereIn('id',$orders)->get();
            else
                $transactions = [];
        }
        return view('admin.transaction.adminVisitTransaction',compact('transactions'));
    }
    //contact
    public function adminVisitContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.adminVisitContact',compact('contacts'));
    }
}
