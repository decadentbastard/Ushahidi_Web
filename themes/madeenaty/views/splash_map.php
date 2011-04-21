<!-- map -->
<div id="region-select">
What's happening <br> in your neighborhood?
  <div style="padding: 5px; margin-left:5px;">
    <form action="/main/region">
      <select style="width:210px;" onchange="this.form.submit()">
      <option>Select your region</option>
      <option>Beirut</option>
      <option>South of Lebanon</option>
      <option>Bekaa</option>
      <option>Tripoli</option>
      </select>
    </form>
  </div>

</div>
<div class="splash-map" id="map"></div>
<div style="clear:both;"></div>
<div id="mapStatus" style="display:none;">
	<div id="mapScale" style="border-right: solid 1px #999"></div>
	<div id="mapMousePosition" style="min-width: 135px;border-right: solid 1px #999;text-align: center"></div>
	<div id="mapProjection" style="border-right: solid 1px #999"></div>
	<div id="mapOutput"></div>
</div>
<div style="clear:both;"></div>
<!-- / map -->
