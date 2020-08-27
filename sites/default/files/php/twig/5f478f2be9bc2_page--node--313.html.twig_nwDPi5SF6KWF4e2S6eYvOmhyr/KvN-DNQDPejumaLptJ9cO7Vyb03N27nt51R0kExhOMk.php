<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* themes/mobile_pundits/templates/page--node--313.html.twig */
class __TwigTemplate_fe67a5c056310867f6e28047f995bb7f2056cda8dad2ef71345a3796975868f6 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["if" => 3];
        $filters = ["escape" => 5];
        $functions = ["drupal_block" => 14, "active_theme_path" => 31];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                ['drupal_block', 'active_theme_path']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        echo "<div  class=\"popup\"></div>
<div  class=\"popup1\"></div>
 ";
        // line 3
        if ($this->getAttribute(($context["page"] ?? null), "header", [])) {
            // line 4
            echo "    <div id=\"header\"> 
        ";
            // line 5
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "header", [])), "html", null, true);
            echo " 
    </div>
 ";
        }
        // line 8
        echo "
 <!--Header end-->

<!--Full page start-->
<div id=\"fullpage\" class='slim_scroller'>
    <div class=\"section section_div home-carousel clearfix\" id=\"section0\" >
         ";
        // line 14
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("carousel_block"), "html", null, true);
        echo "
    </div>
    <!--Section 0 slideshow end-->
    
    <!--Section1 Services start-->
    <div class=\"section \" id=\"section1\">
        <div class=\"container\">
          ";
        // line 21
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("service_block"), "html", null, true);
        echo "
        </div>
    </div>
    <!--Section1 Services start-->
    <!---Section2 Start-->
    <div class=\"section  \" id=\"section2\">
        <div class=\"container-fluid partner-main\">
            <div class=\"container\">
                <div class=\"parnermain-div\">
                    <h4>Trusted development partner of Startups to Fortune 500 companies</h4>
                    <div class=\"partner-div \"> <img src=\"";
        // line 31
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/partne-img.png\" width=\"986\" class=\"img-responsive partner-img\"> <img src=\"";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/partne-img-mob.png\"  class=\"partner-img-mob\"> </div>
                </div>
            </div>
        </div>
        <div class=\"container-fluid client-main\"> <!--change all section-->
            <div class=\"container clients-div\">  
            ";
        // line 37
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("partner_carousel_block"), "html", null, true);
        echo "
                
            </div>
        </div>
    </div>
    <div class=\"section  purple-bg\" id=\"section3\">
        ";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("front_page_resources_block", ["isPage" => "front"]), "html", null, true);
        echo "
    </div>
    <div class=\"section  grey-bgaward\" id=\"section4\"> ";
        // line 45
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("front_page_award_block", ["isPage" => "front"]), "html", null, true);
        echo "
    
        ";
        // line 47
        if ($this->getAttribute(($context["page"] ?? null), "footer", [])) {
            // line 48
            echo "          ";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["page"] ?? null), "footer", [])), "html", null, true);
            echo " 
         ";
        }
        // line 50
        echo "    </div>
 </div>
";
    }

    public function getTemplateName()
    {
        return "themes/mobile_pundits/templates/page--node--313.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  141 => 50,  135 => 48,  133 => 47,  128 => 45,  123 => 43,  114 => 37,  101 => 31,  88 => 21,  78 => 14,  70 => 8,  64 => 5,  61 => 4,  59 => 3,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mobile_pundits/templates/page--node--313.html.twig", "D:\\server\\Apache24\\htdocs\\drupal-893\\themes\\mobile_pundits\\templates\\page--node--313.html.twig");
    }
}
