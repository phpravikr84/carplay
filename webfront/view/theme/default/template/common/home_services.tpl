 <section id="spa" class="populrservices">
        <div class="row">
                <h1><?=$text_featured_services?></h1>
        </div>

        <div class="row column" ng-controller="servicesController">
           
        <div ng-repeat="service in services">
       
            <div class="col-md-4">
            <div class="bot_col">
                <a href="{{service.href}}" title="Category 1" class="populrsrvs">
                <img src="{{service.thumb}}" alt="" title="">
                
                </a>
                <div class="box-detail-name">
                    <a href="{{service.href}}" title="{{service.name}}"><h2 class="font-weight-bold">{{service.name}}</h2></a>
                </div>
                 <span class="bottom1">
                    <p class="category1">{{service.merchants}} Venues Available</p>
                </span>
                 
            </div>
            </div>
      
        </div>


             
        </div>
        </section>
        
      