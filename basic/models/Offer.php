<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "offer".
 *
 * @property integer $id
 * @property string $name
 * @property integer $min_loan
 * @property integer $max_loan
 * @property integer $min_time
 * @property integer $max_time
 * @property integer $min_age
 * @property integer $max_age
 * @property double $min_interest_rate_day
 * @property double $max_interest_rate_day
 * @property double $interest_rate_month
 * @property double $interest_rate_year
 * @property string $document
 * @property string $citizenship
 * @property string $registration
 * @property string $job
 * @property string $payment
 * @property integer $profit_rating
 * @property integer $client_rating
 * @property string $url
 * @property string $description
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Offer extends \yii\db\ActiveRecord
{
    const ACTIVE = 10;
    const PENDING = 5;
    const STOPPED = 1;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'offer';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['min_loan', 'max_loan', 'min_time', 'max_time', 'min_age', 'max_age', 'profit_rating', 'client_rating', 'status', 'created_at', 'updated_at'], 'integer'],
            [['min_interest_rate_day', 'max_interest_rate_day', 'interest_rate_month', 'interest_rate_year'], 'number'],
            [['description'], 'string'],
            [['name', 'document', 'citizenship', 'registration', 'job', 'payment', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'min_loan' => 'Min Loan',
            'max_loan' => 'Max Loan',
            'min_time' => 'Min Time',
            'max_time' => 'Max Time',
            'min_age' => 'Min Age',
            'max_age' => 'Max Age',
            'min_interest_rate_day' => 'Min Interest Rate Day',
            'max_interest_rate_day' => 'Max Interest Rate Day',
            'interest_rate_month' => 'Interest Rate Month',
            'interest_rate_year' => 'Interest Rate Year',
            'document' => 'Document',
            'citizenship' => 'Citizenship',
            'registration' => 'Registration',
            'job' => 'Job',
            'payment' => 'Payment',
            'profit_rating' => 'Profit Rating',
            'client_rating' => 'Client Rating',
            'url' => 'Url',
            'description' => 'Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getStatusName()
    {
        if ($this->status == self::STOPPED) {
            return 'Stopped';
        }
        if ($this->status == self::PENDING) {
            return 'Pending';
        }
        if ($this->status == self::ACTIVE) {
            return 'Active';
        }
    }

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */
    public function calculate($amount,$time)
    {
        if ($this->name == 'Е заем') {
            return $this->ezaim($amount,$time);
        }
        if ($this->name == 'Kredito24') {
            return $this->kredito24($amount,$time);
        }
        if ($this->name == 'LIME - Займ') {
            return $this->limezaim($amount,$time);
        }
        if ($this->name == 'Ferratum') {
            return $this->ferratum($amount,$time);
        }
        if ($this->name == 'MangoMoney') {
            return $this->mangomoney($amount,$time);
        }
        if ($this->name == 'MILI') {
            return $this->mili($amount,$time);
        }
        if ($this->name == 'MoneyMan') {
            return $this->moneyman($amount,$time);
        }
        if ($this->name == 'Moneysto') {
            return $this->moneysto($amount,$time);
        }
        if ($this->name == 'OneClickMoney') {
            return $this->oneclickmoney($amount,$time);
        }
        if ($this->name == 'PAY P.S.') {
            return $this->payps($amount,$time);
        }
        if ($this->name == 'Platiza') {
            return $this->platiza($amount,$time);
        }
    }

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function ezaim($amount,$time)
    {
        $amounts = [2000,2500,3000,3500,4000,4500,5000,5500,6000,6500,7000,7500,8000,8500,9000,9500,10000,10500,11000,11500,12000,12500,13000,13500,14000,14500,15000,15500,16000,16500,17000,17500,18000,18500,19000,19500,20000,20500,21000,21500,22000,22500,23000,23500,24000,24500,25000,25500,26000,26500,27000,27500,28000,28500,29000,29500,30000];

        for ($i=0; $i < count($amounts); $i++) { 
            if ($i < count($amounts) - 1) {
                if ($amount >= $amounts[$i] && $amount < $amounts[$i+1]) {
                    $zaim = $amounts[$i];
                }
            }else{
                if ($amount >= $amounts[$i]) {
                    $zaim = $amounts[$i];
                }
            }
            
        }
        
        $price = json_decode('{"5":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":1709,"16000":1764,"16500":1820,"17000":1875,"17500":1930,"18000":1985,"18500":2040,"19000":2095,"19500":2150,"20000":2205,"20500":2261,"21000":2316,"21500":2371,"22000":2426,"22500":2481,"23000":2536,"23500":2591,"24000":2647,"24500":2702,"25000":2757,"25500":2812,"26000":2867,"26500":2922,"27000":2977,"27500":3033,"28000":3088,"28500":3143,"29000":3198,"29500":3253,"30000":3308},"6":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":2051,"16000":2117,"16500":2183,"17000":2250,"17500":2316,"18000":2382,"18500":2448,"19000":2514,"19500":2580,"20000":2647,"20500":2713,"21000":2779,"21500":2845,"22000":2911,"22500":2977,"23000":3044,"23500":3110,"24000":3176,"24500":3242,"25000":3308,"25500":3374,"26000":3441,"26500":3507,"27000":3573,"27500":3639,"28000":3705,"28500":3771,"29000":3838,"29500":3904,"30000":3970},"7":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":2393,"16000":2470,"16500":2547,"17000":2625,"17500":2702,"18000":2779,"18500":2856,"19000":2933,"19500":3010,"20000":3088,"20500":3165,"21000":3242,"21500":3319,"22000":3396,"22500":3474,"23000":3551,"23500":3628,"24000":3705,"24500":3782,"25000":3860,"25500":3937,"26000":4014,"26500":4091,"27000":4168,"27500":4246,"28000":4323,"28500":4400,"29000":4477,"29500":4554,"30000":4632},"8":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":2735,"16000":2823,"16500":2911,"17000":2999,"17500":3088,"18000":3176,"18500":3264,"19000":3352,"19500":3441,"20000":3529,"20500":3617,"21000":3705,"21500":3793,"22000":3882,"22500":3970,"23000":4058,"23500":4146,"24000":4235,"24500":4323,"25000":4411,"25500":4499,"26000":4587,"26500":4676,"27000":4764,"27500":4852,"28000":4940,"28500":5028,"29000":5117,"29500":5205,"30000":5293},"9":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":3077,"16000":3176,"16500":3275,"17000":3374,"17500":3474,"18000":3573,"18500":3672,"19000":3771,"19500":3871,"20000":3970,"20500":4069,"21000":4168,"21500":4268,"22000":4367,"22500":4466,"23000":4565,"23500":4665,"24000":4764,"24500":4863,"25000":4962,"25500":5062,"26000":5161,"26500":5260,"27000":5359,"27500":5459,"28000":5558,"28500":5657,"29000":5756,"29500":5856,"30000":5955},"10":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":3418,"16000":3529,"16500":3639,"17000":3749,"17500":3860,"18000":3970,"18500":4080,"19000":4190,"19500":4301,"20000":4411,"20500":4521,"21000":4632,"21500":4742,"22000":4852,"22500":4962,"23000":5073,"23500":5183,"24000":5293,"24500":5403,"25000":5514,"25500":5624,"26000":5734,"26500":5845,"27000":5955,"27500":6065,"28000":6175,"28500":6286,"29000":6396,"29500":6506,"30000":6616},"11":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":3760,"16000":3882,"16500":4003,"17000":4124,"17500":4246,"18000":4367,"18500":4488,"19000":4609,"19500":4731,"20000":4852,"20500":4973,"21000":5095,"21500":5216,"22000":5337,"22500":5459,"23000":5580,"23500":5701,"24000":5822,"24500":5944,"25000":6065,"25500":6186,"26000":6308,"26500":6429,"27000":6550,"27500":6672,"28000":6793,"28500":6914,"29000":7035,"29500":7157,"30000":7278},"12":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":4064,"16000":4196,"16500":4327,"17000":4458,"17500":4589,"18000":4720,"18500":4851,"19000":4982,"19500":5113,"20000":5244,"20500":5376,"21000":5507,"21500":5638,"22000":5769,"22500":5900,"23000":6031,"23500":6162,"24000":6293,"24500":6424,"25000":6556,"25500":6687,"26000":6818,"26500":6949,"27000":7080,"27500":7211,"28000":7342,"28500":7473,"29000":7604,"29500":7736,"30000":7867},"13":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":4357,"16000":4498,"16500":4638,"17000":4779,"17500":4919,"18000":5060,"18500":5201,"19000":5341,"19500":5482,"20000":5622,"20500":5763,"21000":5903,"21500":6044,"22000":6184,"22500":6325,"23000":6466,"23500":6606,"24000":6747,"24500":6887,"25000":7028,"25500":7168,"26000":7309,"26500":7449,"27000":7590,"27500":7731,"28000":7871,"28500":8012,"29000":8152,"29500":8293,"30000":8433},"14":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":4650,"16000":4800,"16500":4950,"17000":5100,"17500":5250,"18000":5400,"18500":5550,"19000":5700,"19500":5850,"20000":6000,"20500":6150,"21000":6300,"21500":6450,"22000":6600,"22500":6750,"23000":6900,"23500":7050,"24000":7200,"24500":7350,"25000":7500,"25500":7650,"26000":7800,"26500":7950,"27000":8100,"27500":8250,"28000":8400,"28500":8550,"29000":8700,"29500":8850,"30000":9000},"15":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":4795,"16000":4950,"16500":5105,"17000":5259,"17500":5414,"18000":5569,"18500":5723,"19000":5878,"19500":6033,"20000":6188,"20500":6342,"21000":6497,"21500":6652,"22000":6806,"22500":6961,"23000":7116,"23500":7270,"24000":7425,"24500":7580,"25000":7734,"25500":7889,"26000":8044,"26500":8198,"27000":8353,"27500":8508,"28000":8663,"28500":8817,"29000":8972,"29500":9127,"30000":9281},"16":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":4941,"16000":5100,"16500":5259,"17000":5419,"17500":5578,"18000":5738,"18500":5897,"19000":6056,"19500":6216,"20000":6375,"20500":6534,"21000":6694,"21500":6853,"22000":7013,"22500":7172,"23000":7331,"23500":7491,"24000":7650,"24500":7809,"25000":7969,"25500":8128,"26000":8288,"26500":8447,"27000":8606,"27500":8766,"28000":8925,"28500":9084,"29000":9244,"29500":9403,"30000":9563},"17":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5086,"16000":5250,"16500":5414,"17000":5578,"17500":5742,"18000":5906,"18500":6070,"19000":6234,"19500":6398,"20000":6563,"20500":6727,"21000":6891,"21500":7055,"22000":7219,"22500":7383,"23000":7547,"23500":7711,"24000":7875,"24500":8039,"25000":8203,"25500":8367,"26000":8531,"26500":8695,"27000":8859,"27500":9023,"28000":9188,"28500":9352,"29000":9516,"29500":9680,"30000":9844},"18":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5231,"16000":5400,"16500":5569,"17000":5738,"17500":5906,"18000":6075,"18500":6244,"19000":6413,"19500":6581,"20000":6750,"20500":6919,"21000":7088,"21500":7256,"22000":7425,"22500":7594,"23000":7763,"23500":7931,"24000":8100,"24500":8269,"25000":8438,"25500":8606,"26000":8775,"26500":8944,"27000":9113,"27500":9281,"28000":9450,"28500":9619,"29000":9788,"29500":9956,"30000":10125},"19":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5377,"16000":5550,"16500":5723,"17000":5897,"17500":6070,"18000":6244,"18500":6417,"19000":6591,"19500":6764,"20000":6938,"20500":7111,"21000":7284,"21500":7458,"22000":7631,"22500":7805,"23000":7978,"23500":8152,"24000":8325,"24500":8498,"25000":8672,"25500":8845,"26000":9019,"26500":9192,"27000":9366,"27500":9539,"28000":9713,"28500":9886,"29000":10059,"29500":10233,"30000":10406},"20":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5522,"16000":5700,"16500":5878,"17000":6056,"17500":6234,"18000":6413,"18500":6591,"19000":6769,"19500":6947,"20000":7125,"20500":7303,"21000":7481,"21500":7659,"22000":7838,"22500":8016,"23000":8194,"23500":8372,"24000":8550,"24500":8728,"25000":8906,"25500":9084,"26000":9263,"26500":9441,"27000":9619,"27500":9797,"28000":9975,"28500":10153,"29000":10331,"29500":10509,"30000":10688},"21":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5667,"16000":5850,"16500":6033,"17000":6216,"17500":6398,"18000":6581,"18500":6764,"19000":6947,"19500":7130,"20000":7313,"20500":7495,"21000":7678,"21500":7861,"22000":8044,"22500":8227,"23000":8409,"23500":8592,"24000":8775,"24500":8958,"25000":9141,"25500":9323,"26000":9506,"26500":9689,"27000":9872,"27500":10055,"28000":10238,"28500":10420,"29000":10603,"29500":10786,"30000":10969},"22":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5813,"16000":6000,"16500":6188,"17000":6375,"17500":6563,"18000":6750,"18500":6938,"19000":7125,"19500":7313,"20000":7500,"20500":7688,"21000":7875,"21500":8063,"22000":8250,"22500":8438,"23000":8625,"23500":8813,"24000":9000,"24500":9188,"25000":9375,"25500":9563,"26000":9750,"26500":9938,"27000":10125,"27500":10313,"28000":10500,"28500":10688,"29000":10875,"29500":11063,"30000":11250},"23":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":5958,"16000":6150,"16500":6342,"17000":6534,"17500":6727,"18000":6919,"18500":7111,"19000":7303,"19500":7495,"20000":7688,"20500":7880,"21000":8072,"21500":8264,"22000":8456,"22500":8648,"23000":8841,"23500":9033,"24000":9225,"24500":9417,"25000":9609,"25500":9802,"26000":9994,"26500":10186,"27000":10378,"27500":10570,"28000":10763,"28500":10955,"29000":11147,"29500":11339,"30000":11531},"24":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6103,"16000":6300,"16500":6497,"17000":6694,"17500":6891,"18000":7088,"18500":7284,"19000":7481,"19500":7678,"20000":7875,"20500":8072,"21000":8269,"21500":8466,"22000":8663,"22500":8859,"23000":9056,"23500":9253,"24000":9450,"24500":9647,"25000":9844,"25500":10041,"26000":10238,"26500":10434,"27000":10631,"27500":10828,"28000":11025,"28500":11222,"29000":11419,"29500":11616,"30000":11813},"25":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6248,"16000":6450,"16500":6652,"17000":6853,"17500":7055,"18000":7256,"18500":7458,"19000":7659,"19500":7861,"20000":8063,"20500":8264,"21000":8466,"21500":8667,"22000":8869,"22500":9070,"23000":9272,"23500":9473,"24000":9675,"24500":9877,"25000":10078,"25500":10280,"26000":10481,"26500":10683,"27000":10884,"27500":11086,"28000":11288,"28500":11489,"29000":11691,"29500":11892,"30000":12094},"26":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6394,"16000":6600,"16500":6806,"17000":7013,"17500":7219,"18000":7425,"18500":7631,"19000":7838,"19500":8044,"20000":8250,"20500":8456,"21000":8663,"21500":8869,"22000":9075,"22500":9281,"23000":9488,"23500":9694,"24000":9900,"24500":10106,"25000":10313,"25500":10519,"26000":10725,"26500":10931,"27000":11138,"27500":11344,"28000":11550,"28500":11756,"29000":11963,"29500":12169,"30000":12375},"27":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6539,"16000":6750,"16500":6961,"17000":7172,"17500":7383,"18000":7594,"18500":7805,"19000":8016,"19500":8227,"20000":8438,"20500":8648,"21000":8859,"21500":9070,"22000":9281,"22500":9492,"23000":9703,"23500":9914,"24000":10125,"24500":10336,"25000":10547,"25500":10758,"26000":10969,"26500":11180,"27000":11391,"27500":11602,"28000":11813,"28500":12023,"29000":12234,"29500":12445,"30000":12656},"28":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6684,"16000":6900,"16500":7116,"17000":7331,"17500":7547,"18000":7763,"18500":7978,"19000":8194,"19500":8409,"20000":8625,"20500":8841,"21000":9056,"21500":9272,"22000":9488,"22500":9703,"23000":9919,"23500":10134,"24000":10350,"24500":10566,"25000":10781,"25500":10997,"26000":11213,"26500":11428,"27000":11644,"27500":11859,"28000":12075,"28500":12291,"29000":12506,"29500":12722,"30000":12938},"29":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6830,"16000":7050,"16500":7270,"17000":7491,"17500":7711,"18000":7931,"18500":8152,"19000":8372,"19500":8592,"20000":8813,"20500":9033,"21000":9253,"21500":9473,"22000":9694,"22500":9914,"23000":10134,"23500":10355,"24000":10575,"24500":10795,"25000":11016,"25500":11236,"26000":11456,"26500":11677,"27000":11897,"27500":12117,"28000":12338,"28500":12558,"29000":12778,"29500":12998,"30000":13219},"30":{"2000":0,"2500":0,"3000":0,"3500":0,"4000":0,"4500":0,"5000":0,"5500":0,"6000":0,"6500":0,"7000":0,"7500":0,"8000":0,"8500":0,"9000":0,"9500":0,"10000":0,"10500":0,"11000":0,"11500":0,"12000":0,"12500":0,"13000":0,"13500":0,"14000":0,"14500":0,"15000":0,"15500":6975,"16000":7200,"16500":7425,"17000":7650,"17500":7875,"18000":8100,"18500":8325,"19000":8550,"19500":8775,"20000":9000,"20500":9225,"21000":9450,"21500":9675,"22000":9900,"22500":10125,"23000":10350,"23500":10575,"24000":10800,"24500":11025,"25000":11250,"25500":11475,"26000":11700,"26500":11925,"27000":12150,"27500":12375,"28000":12600,"28500":12825,"29000":13050,"29500":13275,"30000":13500}}');
        return [
            'id' => $this->id,
            'amount' => $zaim,
            'commision' => $price->$time->$zaim,
        ];
    }

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function kredito24($amount,$time)
    {
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => round(($this->min_interest_rate_day/100)*$amount*$time),
        ];
    }

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function limezaim($amount,$time)
    {
        if ($amount <= 10000 && $time <= 5) {
            $commision = 0;
        }else{
            $commision = round(($this->min_interest_rate_day/100)*$amount*$time);
        }
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function ferratum($amount,$time)
    {
        if ($amount <= 10000) {
            $commision = round(($this->max_interest_rate_day/100)*$amount*$time);
        }else{
            $commision = round(($this->min_interest_rate_day/100)*$amount*$time);
        }
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function mangomoney($amount,$time)
    {
        $commision = round(($this->min_interest_rate_day/100)*$amount*$time);
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }

    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function mili($amount,$time)
    {
        $commision = round(($this->min_interest_rate_day/100)*$amount*$time);
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function moneyman($amount,$time)
    {
        if ($amount <= 10000 && $time <= 25) {
            $commision = 0;
        }
        if ($amount <= 10000 && $time > 25 && $time <= 31) {
            $commision = round((1.85/100)*$amount*$time);    
        }
        if ($amount > 10000 && $amount <= 15000 && $time <= 31) {
            $commision = round((1.80/100)*$amount*$time);    
        }
        if ($amount > 15000 && $amount <= 30000 && $time <= 31) {
            $commision = round((1.75/100)*$amount*$time);    
        }
        
        
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function moneysto($amount,$time)
    {
        $commision = round(($this->min_interest_rate_day/100)*$amount*$time);    
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function oneclickmoney($amount,$time)
    {
        $percent = [
            '6' => 1.8,
            '7' => 1.8,
            '8' => 1.9,
            '9' => 1.9,
            '10' => 1.9,
            '11' => 2,
            '12' => 2,
            '13' => 2,
            '14' => 2,
            '15' => 2,
            '16' => 2,
            '17' => 2,
            '18' => 2,
            '19' => 2,
            '20' => 2,
            '21' => 2.1,

        ];
        $commision = round(($percent[$time]/100)*$amount*$time);    
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function payps($amount,$time)
    {
        $percent = [
            '6' => 2.1333333,
            '7' => 2.1,
            '8' => 2.075,
            '9' => 2.05555,
            '10' => 2.04,
            '11' => 2.02727,
            '12' => 2.01666,
            '13' => 2.0076,
            '14' => 2,
            '15' => 1.993333,
            '16' => 1.9875,
            '17' => 1.9823,
            '18' => 1.97777,
            '19' => 1.9736,
            '20' => 1.97,
            '21' => 1.96666,
            '22' => 1.9636,
            '23' => 1.9608,
            '24' => 1.958333,
            '25' => 1.956,


        ];
        $commision = round(($percent[$time]/100)*$amount*$time);    
        
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
    
    /**
    * @param integer amount
    * @param integer time
    * @return array
    */

    public function platiza($amount,$time)
    {
        if ($amount <= 6000) {
            $commision = round(($this->max_interest_rate_day/100)*$amount*$time);    
        }else{
            $commision = round(($this->min_interest_rate_day/100)*$amount*$time);    
        }
        
        return [
            'id' => $this->id,
            'amount' => $amount,
            'commision' => $commision,
        ];
    }
}