
<div class="span12 well">
 <ul class='nav nav-list'>
                <li>{{HTML::link('dashboard','Dashboard')}}</li>
                <li>{{HTML::link('servicereports','Service Reports')}}</li>
                
                @if(Session::get('admin'))
                <li>{{HTML::link('invoices', 'Invoicing') }}</li>
     @endif                  
               @if(Session::get('clientmanager'))
               <li>{{HTML::link('clients','Client Manager')}}</li>
     @endif
               @if(Session::get('humanresource'))
                <li>{{HTML::link('utilizadors', 'Human Resources')}}</li>
     @endif
               @if(Session::get('contractmanager'))
                <li>{{HTML::link('contracts', 'Contract Manager') }}</li>
     @endif
               @if(Session::get('networkmanager'))
                <li>{{HTML::link('networks', 'Network Manager') }}</li>
     @endif               
               @if(Session::get('admin'))
                <li>{{HTML::link('globalvars', 'Global Variables') }}</li>
     @endif
               <li> {{ HTML::link('logout', 'Logout') }}</li>
 </ul>
</div> 
 