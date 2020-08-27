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

/* themes/mobile_pundits/templates/page--innerpagecontenttype.html.twig */
class __TwigTemplate_b9818b263b2f3877fc3502cd0e8c2d66c603a30ee234119ef233338a9c047a10 extends \Twig\Template
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
        $functions = ["drupal_block" => 11];

        try {
            $this->sandbox->checkSecurity(
                ['if'],
                ['escape'],
                ['drupal_block']
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

 ";
        // line 11
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("inner_carousel_block"), "html", null, true);
        echo "

 ";
        // line 13
        if (($this->getAttribute(($context["node"] ?? null), "id", []) == 256)) {
            // line 14
            echo " \t";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("front_page_award_block", ["isPage" => "award"]), "html", null, true);
            echo "
 ";
        }
        // line 16
        echo "
 ";
        // line 17
        if (($this->getAttribute(($context["node"] ?? null), "id", []) == 177)) {
            // line 18
            echo " \t";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("front_page_resources_block", ["isPage" => "resources"]), "html", null, true);
            echo "
 ";
        }
        // line 19
        echo " 

 ";
        // line 21
        if (($this->getAttribute(($context["node"] ?? null), "id", []) == 209)) {
            // line 22
            echo " \t";
            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalBlock("success_stories"), "html", null, true);
            echo "
 ";
        }
        // line 24
        echo "
";
    }

    public function getTemplateName()
    {
        return "themes/mobile_pundits/templates/page--innerpagecontenttype.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  111 => 24,  105 => 22,  103 => 21,  99 => 19,  93 => 18,  91 => 17,  88 => 16,  82 => 14,  80 => 13,  75 => 11,  70 => 8,  64 => 5,  61 => 4,  59 => 3,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mobile_pundits/templates/page--innerpagecontenttype.html.twig", "D:\\server\\Apache24\\htdocs\\drupal-893\\themes\\mobile_pundits\\templates\\page--innerpagecontenttype.html.twig");
    }
}
