<?
require('../../h/tema/menu1.php');
?>

<meta name="description" content="Direnç Hesaplama Aracı (Resistance calculator) » EPfarki.com Hizmetleri » Birazcık Farklı" />
<meta name="keywords" content="Resistance calculator, epfarki, ep, farki, evrensel, paylasim, evrenselpaylasim, farkı, farklı, farkli, fark, " />
<title>Direnç Hesaplama Aracı (Resistance calculator)</title>
<style type="text/css">
  <!--
  select {
    font-family:verdana;
    font-size:10px;
    font-weight:normal;
  }
  input.script {
    font-family:verdana;
    font-size:10px;
    font-weight:normal;
  }
  table.script2 {
    font-size:11px;
    font-weight:bold;
  }
  -->
</style>

<script type="text/javascript">
  <!--
  /* This script and many more are available free online at
   The JavaScript Source!! http://javascript.internet.com
   Created by: Curt Turner :: http://www.turner3d.net */

  ohmStr=String.fromCharCode(937);
  base10=Math.log(10);
  function preLoad(){
    // preload color-band images
    arrCols=new Array();
    srcBase=document.getElementById('sel1');
    for(i=0;i<srcBase.length;i++){
      arrCols[i]=srcBase.options[i].value;
    }
    arrImg=new Array();
    for(i=0;i<arrCols.length;i++){
      for(j=0;j<3;j++){
        arrImg[i*3+j]=new Image();
        arrImg[i*3+j].src='band_'+arrCols[i]+(j+1).toString()+'.jpg';
      }
    }
    pre1=new Image();
    pre1.src='band_d3.jpg';
    pre2=new Image();
    pre2.src='band_s3.jpg';
    pre3=new Image();
    pre3.src='band_mult_s.jpg';
  }
  function selCol(what,band){
    // display color-band image
    eval("document.getElementById('band"+band+"').src='band_"+what.value+band+".jpg';");
  }
  function selTol(){
    // display tolerance band, set tolerance numeric dropdown
    document.getElementById('mult').src='band_mult_'+document.getElementById('tolerance').value+'.jpg';
    document.getElementById('tolNum').selectedIndex=document.getElementById('tolerance').selectedIndex;
    calc();
  }
  function tolRev(){
    // display tolerance band, set tolerance color dropdown
    document.getElementById('tolerance').selectedIndex=document.getElementById('tolNum').selectedIndex;
    document.getElementById('mult').src='band_mult_'+document.getElementById('tolerance').value+'.jpg';
    calc();
  }
  function calc(){
    // calculate values from color selections
    pow=document.getElementById('sel3').selectedIndex;
    if(pow==10)pow=-1; //gold
    if(pow==11)pow=-2; //silver
    //note: Multiplied resistance value by 100 (pow+2), rounded to nearest integer, then divided
    //  result by 100 to compensate for Javascript exponentiation errors (only need 2 significant digits)
    res=Math.round((document.getElementById('sel1').selectedIndex*10+document.getElementById('sel2').selectedIndex)*Math.pow(10,pow+2))/100;
    if(res>990000){
      document.getElementById('multSel').selectedIndex=2;
      res/=1000000;
    }else if(res>990){
      document.getElementById('multSel').selectedIndex=1;
      res/=1000;
    }else{
      document.getElementById('multSel').selectedIndex=0;
    }
    if(res>999){
      res=res.toString();
      res=res.substr(0,res.length-3)+','+res.substr(res.length-3,3);
    }
    tolOut=5*Math.pow(2,document.getElementById('tolerance').selectedIndex)
    document.getElementById('txtNum').value=res;
  }
  function calcRev(){
    // calculates color selections from numeric input
    // convert input to ohms
    document.getElementById('errSpan').innerHTML='';
    base=document.getElementById('txtNum').value;
    if(parseFloat(base).toString()=='NaN')return false;
    if(base==0)return false;
    multBy=Math.pow(1000,document.getElementById('multSel').selectedIndex);
    res=base*multBy;
    if((res>99000000000)||(res<.1)){
      inputError();
      return false;
    }
    raisedTo=Math.floor(Math.log(res)/base10);
    res=Math.round(res/Math.pow(10,raisedTo-1))/10;
    d1=Math.floor(res);
    d2=Math.round((res-d1)*10);
    if(d1==10){
      d1=1;
      d2=0;
      raisedTo+=1;
    }
    mIndex=raisedTo-1;
    if(mIndex==-1)mIndex=10;
    if(mIndex==-2)mIndex=11;
    document.getElementById('sel1').selectedIndex=d1;
    selCol(document.getElementById('sel1'),1);
    document.getElementById('sel2').selectedIndex=d2;
    selCol(document.getElementById('sel2'),2);
    document.getElementById('sel3').selectedIndex=mIndex;
    selCol(document.getElementById('sel3'),3);
  }
  function inputError(){
    for(i=1;i<4;i++){
      eval("document.getElementById('sel"+i+"').selectedIndex=0;");
      eval("document.getElementById('band"+i+"').src='band_k"+i+".jpg';");
    }
    document.getElementById('errSpan').innerHTML="<br>Alan dışı veri";
  }
  -->
</script>
<?
require('../../h/tema/menu2.php');
?>

<div id="title-hizmet" class="title"><h3>

    <a href="http://epfarki.com/hizmet/direnc-hesapla/" rel="bookmark" title="Direnç Hesaplama Aracı">Direnç Hesaplama Aracı</a>

  </h3></div> <div class="temiz"></div>


<div onload='calc();preLoad()'>
  <table border=0 cellpadding=0 cellspacing=0 style="border:1px solid #000000;background-color:#ffffff;" align="center" class="script2">
    <tr>
      <td colspan=9 style="padding:3px;background-color:#000000;color:#ffffff;font-family:Verdana;" align="center">Direnç Hesaplama Aracı <br>(Resistance calculator) <span style='color:#ff0000' id=errSpan></span></td>

    </tr>
    <tr>
      <td colspan=9 align=center style="padding:5px;padding-bottom:20px;background-image:url(bkgTop.gif);">
        <select id=sel1 size=1 onchange="selCol(this,1);calc();">
          <option value=k>Siyah</option>
          <option value=n>Kahve</option>
          <option value=r>Kırmızı</option>
          <option value=o>Turuncu</option>
          <option value=y>Sarı</option>
          <option value=g>Yeşil</option>
          <option value=b>Mavi</option>
          <option value=v>Mor</option>
          <option value=a>Gri</option>
          <option value=w>Beyaz</option>
        </select>

        <select id=sel2 size=1 onchange="selCol(this,2);calc();">
          <option value=k>Siyah</option>
          <option value=n>Kahve</option>
          <option value=r>Kırmızı</option>
          <option value=o>Turuncu</option>
          <option value=y>Sarı</option>
          <option value=g>Yeşil</option>
          <option value=b>Mavi</option>
          <option value=v>Mor</option>
          <option value=a>Gri</option>
          <option value=w>Beyaz</option>
        </select>

        <select id=sel3 size=1 onchange="selCol(this,3);calc();">

          <option value=k>Siyah</option>
          <option value=n>Kahve</option>
          <option value=r>Kırmızı</option>
          <option value=o>turuncu</option>
          <option value=y>Sarı</option>
          <option value=g>Yeşil</option>
          <option value=b>Mavi</option>
          <option value=v>Mor</option>
          <option value=a>Gri</option>

          <option value=w>Beyaz</option>
          <option value=d>Altın</option>
          <option value=s>Gümüş</option>
        </select>

        <select id=tolerance size=1 onchange="selTol()">
          <option value=g>Altın</option>
          <option value=s>Gümüş</option>
          <option value=n>Yok</option>
        </select>

      </td>
    </tr>
    <tr>
      <td><img src="lead_l.jpg" width=101 height=68></td>
      <td style="background-image:url(band_k1.jpg)"><img id=band1 src="band_k1.jpg" width=16 height=68></td>
      <td><img src="fill_1.jpg" width=8 height=68></td>
      <td style="background-image:url(band_k2.jpg)"><img id=band2 src="band_k2.jpg" width=12 height=68></td>
      <td><img src="fill_2.jpg" width=11 height=68></td>
      <td style="background-image:url(band_k3.jpg)"><img id=band3 src="band_k3.jpg" width=12 height=68></td>
      <td><img src="fill_3.jpg" width=16 height=68></td>

      <td style="background-image:url(band_mult_n.jpg)"><img id=mult src="band_mult_g.jpg" width=10 height=68></td>
      <td><img src="lead_r.jpg" width=114 height=68></td>
    </tr>
    <tr>
      <td colspan=9 align=center style="padding-top:5px;padding-bottom:3px;">
        <input type=text id=txtNum size=6 style="text-align:right" onkeyup='calcRev()'><select size=1 id=multSel onchange='calcRev()' class="script">
          <option value=0><script>document.write(ohmStr)</script></option>
          <option value=1>K<script>document.write(ohmStr)</script></option>
          <option value=2>M<script>document.write(ohmStr)</script></option>

        </select><select size=1 id=tolNum onchange='tolRev()'>
          <option value=0>±5%</option>
          <option value=1>±10%</option>
          <option value=2>±20%</option>
        </select>
      </td>
    </tr>
  </table>
</div>

<?
require('../../h/tema/menu3.php');
?>
