


<section id="spa">
  <section id="category">
    <div class="row">
    <h1><?=$text_categories?>	</h1>
    </div>
    <div class="row column" >
      <div class="row column" ng-controller="categoriesController">
        <div class="col-md-4" ng-repeat="post in posts"> <a href="{{post.href}}" title="{{post.name}}"> <img src="{{post.image}}" alt="" title=""> <span class="bottom">
          <p class="category">{{post.name}}</p>
          <p class="total_shop">{{post.total_merchants}} Options</p>
          </span> </a> </div>
      </div>
    </div>
  </section>
</section>
<section id="spa">
  <section id="category">
    <div ng-controller="subcategoriesController">
      <div ng-if="subcat" ng-repeat="scat in subcat">
      
        <div class="row">
          <h1>{{scat.name}} </h1>
        </div>
        <div class="row column">
          <div ng-repeat="child in scat.children">
            <div class="col-md-4"> <a href="{{child.href}}" title="{{child.name}}"> <img src="{{child.thumb}}" alt="" title=""> <span class="bottom">
              <p class="category">{{child.name}}</p>
              <p class="total_shop"> {{child.total_merchants}} Options</p>
              </span> </a> </div>
          </div>
        </div>
        
        
      </div>
    </div>
  </section>
</section>