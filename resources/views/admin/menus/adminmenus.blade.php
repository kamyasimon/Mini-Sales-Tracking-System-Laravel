<div class="row">
    <div class="col-12">
        <ul class="d-flex flex-row justify-content-around align-items-center">
        <a href="/dashboard"> <li>Dashboard</li></a>
        @if(Auth::user()->fkrole == 2 )  
       
        <a href="/companies"> <li>Companies</li></a>
        <a href="/products"> <li>Products</li></a>
        <a href="/users"> <li>Users</li></a>
        @endif
            
            <a href="/stock"> <li>stock</li></a>
           <a href="/sales"> <li>Sales</li></a>
           <a href="/expenses"> <li>Expenses</li></a>
           <a href="/bookings"> <li>Bookings and likes</li></a>
           <a href="/loans"> <li>Items on Loan</li></a>
        </ul>
    </div>
</div>