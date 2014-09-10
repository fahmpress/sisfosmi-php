<?php
function combotgl($awal, $akhir, $var, $terpilih){
  echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    $lebar=strlen($i);
    switch($lebar){
      case 1:
      {
        $g="0".$i;
        break;     
      }
      case 2:
      {
        $g=$i;
        break;     
      }      
    }  
    if ($i==$terpilih)
      echo "<option value=$g selected>$g</option>";
    else
      echo "<option value=$g>$g</option>";
  }
  echo "</select> ";
}

function combobln($awal, $akhir, $var, $terpilih){
  echo "<select name=$var>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
    $lebar=strlen($bln);
    switch($lebar){
      case 1:
      {
        $b="0".$bln;
        break;     
      }
      case 2:
      {
        $b=$bln;
        break;     
      }      
    }  
      if ($bln==$terpilih)
         echo "<option value=$b selected>$b</option>";
      else
        echo "<option value=$b>$b</option>";
  }
  echo "</select> ";
}

function combothn($awal, $akhir, $var){
  echo "<select name=$var>";
  for ($i=$awal; $i<=$akhir; $i++){
    if ($i==$awal)
      echo "<option value= selected>Pilih tahun</option>";
    else
      echo "<option value=$i>$i</option>";
  }
  echo "</select> ";
}

function combonamabln($awal, $akhir, $var, $terpilih){
  $nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                      "Juni", "Juli", "Agustus", "September", 
                      "Oktober", "November", "Desember");
  echo "<select name=$var>";
  for ($bln=$awal; $bln<=$akhir; $bln++){
      if ($bln==$terpilih)
         echo "<option value=$bln selected>$nama_bln[$bln]</option>";
      else
        echo "<option value=$bln>$nama_bln[$bln]</option>";
  }
  echo "</select> ";
}

function combojur($var){
  echo "<select name=$var>";
       echo "<option value= selected>Pilih jurusan</option>";
       echo "<option value=11>Sipil</option>";
       echo "<option value=21>Mesin</option>";
       echo "<option value=31>Tekom</option>";
       echo "<option value=41>Bisnis</option>";
  
  echo "</select> ";
}

function combosemester($var){
  echo "<select name=$var>";
       echo "<option value= selected>Pilih semester</option>";
       echo "<option value=1>1</option>";
       echo "<option value=2>2</option>";
       echo "<option value=3>3</option>";
       echo "<option value=4>4</option>";
       echo "<option value=5>5</option>";
       echo "<option value=6>6</option>";
  
  echo "</select> ";
}

function comboket($var){
    echo "<select name=$var>
    <option value='none' selected='selected'>Pilih opsi</option>
    <option value='LUNAS'>LUNAS</option>
    <option value='KREDIT'>KREDIT</option>
    </select>";
}

?>
