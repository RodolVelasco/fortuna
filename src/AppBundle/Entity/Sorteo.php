<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="SorteoRepository"))
 * @ORM\Table(name="sorteo")
 * @ORM\HasLifecycleCallbacks
 */
class Sorteo {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="AppBundle\Doctrine\RandomIdGenerator")
     */
    protected $id;

    /*
        fotos
        titulo
        descripcion
        precio
        color
        condicion
    */

    /**
     * @var string $titulo
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string $descripcion
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var string $precio
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $precio;

    /**
     * @var string $ganancia
     *
     * @ORM\Column(name="ganancia", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $ganancia;

    /**
     * @var integer $costoPorNumero
     *
     * @ORM\Column(name="costo_por_numero", type="integer", length=2, nullable=false)
     */
    private $costoPorNumero;

    /**
     * @var integer $cantidadNumeroPermitido
     *
     * @ORM\Column(name="cantidad_numero_permitido", type="integer", length=3, nullable=false)
     */
    private $cantidadNumeroPermitido;

    /**
     * @var integer $tipoPagoPorMonedero
     *
     * @ORM\Column(name="tipo_pago_por_monedero", type="integer", length=1, nullable=false)
     */
    private $tipoPagoPorMonedero;

    /**
     * @var integer $tipoSorteo
     *
     * @ORM\Column(name="tipo_sorteo", type="integer", length=1, nullable=false)
     */
    private $tipoSorteo;

    /**
     * @var integer $numeroGanador
     *
     * @ORM\Column(name="numero_ganador", type="integer", length=2, nullable=true)
     */
    private $numeroGanador;

    /**
     * @var integer $estado
     *
     * @ORM\Column(name="estado", type="integer", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="fecha_creacion", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $fechaCreacion;

    /**
     * @var \DateTime $ultimaActividad
     *
     * @ORM\Column(name="fecha_ultima_actividad", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    protected $fechaUltimaActividad;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\image", cascade={"remove", "persist"})
    */
    private $primeraImage;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\image", cascade={"remove", "persist"})
    */
    private $segundaImage;

    /**
    * @ORM\OneToOne(targetEntity="AppBundle\Entity\image", cascade={"remove", "persist"})
    */
    private $terceraImage;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Participa", mappedBy="sorteo")
     */
    protected $participantes;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ganadores")
     * @ORM\JoinColumn(name="ganador_id", referencedColumnName="id", nullable=true)
     *
     */
    protected $ganador;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="creadores")
     * @ORM\JoinColumn(name="creador_id", referencedColumnName="id", nullable=true)
     *
    */
    protected $creador;


    //protected $consultations;


    /************ constructeur ************/

    public function __construct()
    {
        //parent::__construct();
        $this->fechaCreacion = new \DateTime;
        $this->fechaUltimaActividad = new \DateTime;
        $this->primeraImage= new \AppBundle\Entity\image();
        $this->segundaImage= new \AppBundle\Entity\image();
        $this->terceraImage= new \AppBundle\Entity\image();
        $this->participantes = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->consultations = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /************ getters & setters  ************/

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return profile
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string descripcion
     * @return profile
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return profile
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Sorteo
     */
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }

    /**
     * Set fechaUltimaActividad
     *
     * @param \DateTime $fechaUltimaActividad
     * @return Sorteo
     */
    public function setFechaUltimaActividad($fechaUltimaActividad) {
        $this->fechaUltimaActividad = $fechaUltimaActividad;

        return $this;
    }

    /**
     * Get fechaUltimaActividad
     *
     * @return \DateTime
     */
    public function getFechaUltimaActividad() {
        return $this->fechaUltimaActividad;
    }

    /**
     * Set fechaUltimaActividad
     *
     * @param \DateTime $fechaUltimaActividad
     * @return User
     */
    public function isActiveNow() {
        $this->fechaUltimaActividad = new \DateTime();

        return $this;
    }

    /**
     * Set primeraImage
     *
     * @param \AppBundle\Entity\image $image
     * @return profile
     */
    public function setPrimeraImage(\AppBundle\Entity\image $primeraImage = null)
    {
        $this->primeraImage = $primeraImage;

        return $this;
    }

    /**
     * Get primeraImage
     *
     * @return \AppBundle\Entity\image
     */
    public function getPrimeraImage()
    {
        return $this->primeraImage;
    }

    /**
     * Set segundaImage
     *
     * @param \AppBundle\Entity\image $image
     * @return profile
     */
    public function setSegundaImage(\AppBundle\Entity\image $segundaImage = null)
    {
        $this->segundaImage = $segundaImage;

        return $this;
    }

    /**
     * Get segundaImage
     *
     * @return \AppBundle\Entity\image
     */
    public function getSegundaImage()
    {
        return $this->segundaImage;
    }

    /**
     * Set terceraImage
     *
     * @param \AppBundle\Entity\image $image
     * @return profile
     */
    public function setTerceraImage(\AppBundle\Entity\image $terceraImage = null)
    {
        $this->terceraImage = $terceraImage;

        return $this;
    }

    /**
     * Get terceraImage
     *
     * @return \AppBundle\Entity\image
     */
    public function getTerceraImage()
    {
        return $this->terceraImage;
    }


    /**
     * Get avatar primeraImage
     *
     * @return string
     */
    public function getAvatarPrimeraImage() {

        return $this->primeraImage->getWebPath();
    }

    /**
     * Get avatar segundaImage
     *
     * @return string
     */
    public function getAvatarSegundaImage() {

        return $this->segundaImage->getWebPath();
    }

    /**
     * Get avatar terceraImage
     *
     * @return string
     */
    public function getAvatarTerceraImage() {

        return $this->terceraImage->getWebPath();
    }

    /**
     * Add participantes
     *
     * @param \AppBundle\Entity\Participa $participantes
     * @return Participa
     */
    public function addParticipantes(\AppBundle\Entity\Participa $participantes)
    {
        $this->participantes[] = $participantes;

        return $this;
    }

    /**
     * Remove participantes
     *
     * @param \AppBundle\Entity\Participa $participantes
     */
    public function removeParticipantes(\AppBundle\Entity\Participa $participantes)
    {
        $this->participantes->removeElement($participantes);
    }

    /**
     * Get participantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set ganador
     *
     * @param \AppBundle\Entity\User $user
     * @return User
     */
    public function setGanador(\AppBundle\Entity\User $ganador = null)
    {
        $this->ganador = $ganador;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getGanador()
    {
        return $this->ganador;
    }

    /**
     * Set creador
     *
     * @param \AppBundle\Entity\User $user
     * @return User
     */
    public function setCreador(\AppBundle\Entity\User $creador = null)
    {
        $this->creador = $creador;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * Set costoPorNumero
     *
     * @param integer $costoPorNumero
     *
     * @return Sorteo
     */
    public function setCostoPorNumero($costoPorNumero)
    {
        $this->costoPorNumero = $costoPorNumero;

        return $this;
    }

    /**
     * Get costoPorNumero
     *
     * @return integer
     */
    public function getCostoPorNumero()
    {
        return $this->costoPorNumero;
    }

    /**
     * Set cantidadNumeroPermitido
     *
     * @param integer $cantidadNumeroPermitido
     *
     * @return Sorteo
     */
    public function setCantidadNumeroPermitido($cantidadNumeroPermitido)
    {
        $this->cantidadNumeroPermitido = $cantidadNumeroPermitido;

        return $this;
    }

    /**
     * Get cantidadNumeroPermitido
     *
     * @return integer
     */
    public function getCantidadNumeroPermitido()
    {
        return $this->cantidadNumeroPermitido;
    }

    /**
     * Set tipoPagoPorMonedero
     *
     * @param integer $tipoPagoPorMonedero
     *
     * @return Sorteo
     */
    public function setTipoPagoPorMonedero($tipoPagoPorMonedero)
    {
        $this->tipoPagoPorMonedero = $tipoPagoPorMonedero;

        return $this;
    }

    /**
     * Get tipoPagoPorMonedero
     *
     * @return integer
     */
    public function getTipoPagoPorMonedero()
    {
        return $this->tipoPagoPorMonedero;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Sorteo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add participante
     *
     * @param \AppBundle\Entity\Participa $participante
     *
     * @return Sorteo
     */
    public function addParticipante(\AppBundle\Entity\Participa $participante)
    {
        $this->participantes[] = $participante;

        return $this;
    }

    /**
     * Remove participante
     *
     * @param \AppBundle\Entity\Participa $participante
     */
    public function removeParticipante(\AppBundle\Entity\Participa $participante)
    {
        $this->participantes->removeElement($participante);
    }

    /**
     * Set ganancia
     *
     * @param integer $ganancia
     *
     * @return Sorteo
     */
    public function setGanancia($ganancia)
    {
        $this->ganancia = $ganancia;

        return $this;
    }

    /**
     * Get ganancia
     *
     * @return integer
     */
    public function getGanancia()
    {
        return $this->ganancia;
    }

    /**
     * Set tipoSorteo
     *
     * @param integer $tipoSorteo
     *
     * @return Sorteo
     */
    public function setTipoSorteo($tipoSorteo)
    {
        $this->tipoSorteo = $tipoSorteo;

        return $this;
    }

    /**
     * Get tipoSorteo
     *
     * @return integer
     */
    public function getTipoSorteo()
    {
        return $this->tipoSorteo;
    }

    /**
     * Set numeroGanador
     *
     * @param integer $numeroGanador
     *
     * @return Sorteo
     */
    public function setNumeroGanador($numeroGanador)
    {
        $this->numeroGanador = $numeroGanador;

        return $this;
    }

    /**
     * Get numeroGanador
     *
     * @return integer
     */
    public function getNumeroGanador()
    {
        return $this->numeroGanador;
    }
    
    public function __toString() {
        return $this->getTitulo();
    }
}
