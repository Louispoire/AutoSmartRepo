<div>
  <form action="updateCar.php" method="POST">
    <h4 class="text-warning text-center pt-5"><?php echo "Update car #$carid_num";?></h4>
     
      <label>
        <input type="hidden" class="input" name="carid" value="<?php echo $carid_num?>"/>
      </label>
      
      <label>
      <select class="input" name="category">
          <option value="1">Sports Car</option>
          <option value="2">SUV</option>
          <option value="3">Sedans</option>
        </select>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
    <label>
        <input type="text" class="input" name="cartitle" placeholder="Enter car name:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
    <label>
        <input type="number" class="input" name="carprice" placeholder="Enter price:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    
    <label>
        <input type="text" class="input" name="cardesc" placeholder="Enter car description:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
      
     <label>
        <input type="number" class="input" name="carstock" placeholder="Enter car current stock:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    
    <label>
      <select class="input" name="carsize">
          <option value="1">Muscle</option>
          <option value="2">Midsize Sedan</option>
          <option value="3">Midsize SUV</option>
          <option value="4">Vividly Horrendous SUV</option>
          <option value="5">Sports Car</option>
        </select>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>

    <label>
        <p><strong>Please note that the image should be 480 x 360</strong></p>
        <input type="text" class="input" name="carimage" placeholder="Enter image url:"/>
        <div class="line-box">
          <div class="line"></div>
        </div>
    </label>
    <button class="normal-button" type="submit"><?php echo "Update #$carid_num";?></button>
  </form>
</div>
