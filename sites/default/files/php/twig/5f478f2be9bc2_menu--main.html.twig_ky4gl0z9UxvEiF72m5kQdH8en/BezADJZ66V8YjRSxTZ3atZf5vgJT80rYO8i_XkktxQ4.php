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

/* themes/mobile_pundits/templates/menu--main.html.twig */
class __TwigTemplate_52b8162bdc32aaf7418b1d8642f84f8bc4f45ebe2afd6a5dc6fe306932d04026 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $tags = ["import" => 53, "macro" => 60, "if" => 62, "for" => 71, "set" => 93];
        $filters = ["escape" => 8, "length" => 83, "raw" => 123];
        $functions = ["active_theme_path" => 8, "drupal_entity" => 48, "link" => 127];

        try {
            $this->sandbox->checkSecurity(
                ['import', 'macro', 'if', 'for', 'set'],
                ['escape', 'length', 'raw'],
                ['active_theme_path', 'drupal_entity', 'link']
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
        echo "
<div class=\"top-barmain clearfix\">
<div class=\"container-fluid\">
<div class=\"top-bar clearfix\">
<div class=\"col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-left nopadding free-touch\">
<div class=\"col-lg-1 col-md-1 col-sm-1 col-xs-1 usericon-left\">
<span class=\"pull-left\">
         <img src=\"";
        // line 8
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/checklist-icon.png\"  ></span> </div>
                    <div class=\"col-md-9 col-lg-9  col-sm-9  col-xs-9 nopadding\">
                      <h3><span class=\"color-red\"> 50 Points checklist</span> for creating a <span class=\"color-red\">Mobile Application  </span> for the Enterprise </h3>
                    </div>
                    <div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 nopadding talk-btn\"><!--add  id of a button and add <a> on lets talk-->
                      <a href=\"Checklist_For_Mobile_Application_Development.html\"  ><button id=\"lets_talk_btn1\" class=\"btn btn-success\" type=\"button\">Get Checklist</button></a>
                    </div>
          
                  </div>
                  <div class=\"col-lg-4 col-md-4  col-sm-12 col-xs-12  pull-right right-topbar\">
                    <div class=\"ph-sec clearfix \">
                    <div class=\"nopadding ph \"> <span id=\"contact_no\">+1-732-654-9056</span></div>
                    <div class=\"nopadding ph-no \">
                         <div class=\"ph-dropdown\">
                          <span class=\"ph-circle\">
      <img src=\"";
        // line 23
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["base_path"] ?? null)), "html", null, true);
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getActiveThemePath(), "html", null, true);
        echo "/images/phone.svg\" width=\"32\" height=\"32\" class=\"svg\"> </span> 
                            <select id=\"contact_list\" class=\"  form-control selectpicker\" >
                             <option value=\"+1-732-654-9056\">United States</option>
                              <option value=\"+61-2-8015-5723\">Australia</option>
                              
                                <option value=\"+33-7-68-79-77-46\">France</option>                                
                                <option value=\"+91-731-402-5351\">India</option>
                              </select>
                           </div>
                      </div>
                     </div>
                      </div>
                  </div>
                </div>
              </div>
          ";
        // line 39
        echo "



<div ";
        // line 43
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["attributes"] ?? null), "addClass", [0 => "container-fluid", 1 => "top-nav"], "method")), "html", null, true);
        echo ">
<div class=\"navbar navbar-default\" role=\"navigation\">
";
        // line 46
        echo "<div class=\"navbar-header\">
<button type =\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\" > <span class=\"sr-only\">Toggle navigation </span> <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> <span class=\"icon-bar\"></span> </button>
<span class=\"navbar-brand\">";
        // line 48
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\twig_tweak\TwigExtension')->drupalEntity("block", "mobile_pundits_branding", null, null, false), "html", null, true);
        echo "</span> 
</div>

";
        // line 52
        echo "<div class=\"navbar-collapse collapse nopadding\">
";
        // line 53
        $context["menus"] = $this;
        // line 54
        echo "      ";
        // line 58
        echo "      ";
        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links(($context["items"] ?? null), ($context["attributes"] ?? null), 0));
        echo "
      
      ";
        // line 157
        echo "   </div>
   </div>
   </div>";
    }

    // line 60
    public function getmenu_links($__items__ = null, $__attributes__ = null, $__menu_level__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals([
            "items" => $__items__,
            "attributes" => $__attributes__,
            "menu_level" => $__menu_level__,
            "varargs" => $__varargs__,
        ]);

        $blocks = [];

        ob_start(function () { return ''; });
        try {
            // line 61
            echo "        ";
            $context["menus"] = $this;
            // line 62
            echo "        ";
            if (($context["items"] ?? null)) {
                // line 63
                echo "          ";
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 64
                    echo "            <ul class=\"nav navbar-nav  pull-right main-nav\">
          ";
                } else {
                    // line 66
                    echo "          
          
          <div class=\"col-xs-5 no-padding\">
           <ul> 
          ";
                }
                // line 71
                echo "          ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 72
                    echo "            ";
                    if ($this->getAttribute($context["item"], "below", [])) {
                        // line 73
                        echo "              ";
                        if ((($context["menu_level"] ?? null) == 0)) {
                            // line 74
                            echo "        
                <li class=\"dropdown dropdown_main_menu ";
                            // line 75
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["item"], "in_active_trail", [])) ? ("active") : ("")));
                            echo "\"> 
                  <a href=\"";
                            // line 76
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                            echo "\"  class=\"dropdown-toggle\" data-toggle=\"dropdown\" aria-expanded=\"true\"> ";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                            echo "
          ";
                            // line 77
                            if ($this->getAttribute($context["item"], "below", [])) {
                                // line 78
                                echo "          <span class=\"caret\"></span>
          ";
                            }
                            // line 80
                            echo "          </a>
                <div ";
                            // line 81
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($this->getAttribute($context["item"], "attributes", []), "addClass", [0 => "dropdown-menu", 1 => "main-drop-menu"], "method")), "html", null, true);
                            echo " aria-labelledby=\"dropdownMenu\"> 
        <div class=\"row\"> 
          <div class=\"";
                            // line 83
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((twig_length_filter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "below", []))) > 6)) ? ("col-xs-4") : ("col-xs-7")));
                            echo "\">
          <div class=\"dropmenu-img\">
          ";
                            // line 85
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute(($context["items"] ?? null), "attributes", [])), "html", null, true);
                            echo "  
         
            <img src=\"";
                            // line 87
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "field_main_menu_image", [])), "html", null, true);
                            echo "\" title=\"";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "field_main_menu_image", [])), "html", null, true);
                            echo "\">
          
          </div>
          </div>
          <div class=\"";
                            // line 91
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((((twig_length_filter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "below", []))) > 6)) ? ("col-xs-8") : ("col-xs-5")));
                            echo " no-padding\">
          ";
                            // line 92
                            if (twig_length_filter($this->env, $this->getAttribute($context["item"], "below", []))) {
                                // line 93
                                echo "          ";
                                $context["itemPerColumn"] = 6;
                                // line 94
                                echo "
          ";
                                // line 95
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "below", []));
                                $context['loop'] = [
                                  'parent' => $context['_parent'],
                                  'index0' => 0,
                                  'index'  => 1,
                                  'first'  => true,
                                ];
                                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                                    $length = count($context['_seq']);
                                    $context['loop']['revindex0'] = $length - 1;
                                    $context['loop']['revindex'] = $length;
                                    $context['loop']['length'] = $length;
                                    $context['loop']['last'] = 1 === $length;
                                }
                                foreach ($context['_seq'] as $context["_key"] => $context["itemsub"]) {
                                    // line 96
                                    echo "
            ";
                                    // line 97
                                    if (((($context["itemPerColumn"] ?? null) == 1) || (($this->getAttribute($context["loop"], "index", []) % ($context["itemPerColumn"] ?? null)) == 1))) {
                                        // line 98
                                        echo "                <ul>
            ";
                                    }
                                    // line 100
                                    echo "
                <li class=\"";
                                    // line 101
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["itemsub"], "in_active_trail", [])) ? ("active") : ("")));
                                    echo "\"><a class=\"dropdown_list_values\" href=\"";
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["itemsub"], "url", [])), "html", null, true);
                                    echo "\">";
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["itemsub"], "title", [])), "html", null, true);
                                    echo "</a></li>

            ";
                                    // line 103
                                    if (($this->getAttribute($context["loop"], "last", []) || (($this->getAttribute($context["loop"], "index", []) % ($context["itemPerColumn"] ?? null)) == 0))) {
                                        // line 104
                                        echo "                </ul>
            ";
                                    }
                                    // line 106
                                    echo "
          ";
                                    ++$context['loop']['index0'];
                                    ++$context['loop']['index'];
                                    $context['loop']['first'] = false;
                                    if (isset($context['loop']['length'])) {
                                        --$context['loop']['revindex0'];
                                        --$context['loop']['revindex'];
                                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                                    }
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itemsub'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 108
                                echo "        ";
                            }
                            // line 109
                            echo "          </div> 
          </div>
          </div>
                </li>
              ";
                        } else {
                            // line 114
                            echo "                <li class=\"dropdown-submenu\">
                  <a href=\"";
                            // line 115
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", [])), "html", null, true);
                            echo "\">";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "title", [])), "html", null, true);
                            echo "</a>  
                  ";
                            // line 116
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($context["menus"]->getmenu_links($this->getAttribute($context["item"], "below", []), ($context["attributes"] ?? null), (($context["menu_level"] ?? null) + 1)));
                            echo "
                </li>
              ";
                        }
                        // line 119
                        echo "            ";
                    } else {
                        // line 120
                        echo "            
        ";
                        // line 121
                        $context["menutitle"] = $this->getAttribute($context["item"], "title", []);
                        // line 122
                        echo "        ";
                        $context["newTitle"] = ($context["menutitle"] ?? null);
                        // line 123
                        echo "        ";
                        ob_start(function () { return ''; });
                        echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar($this->sandbox->ensureToStringAllowed(($context["newTitle"] ?? null)));
                        $context["link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
                        // line 124
                        echo "        ";
                        if ((($context["menutitle"] ?? null) == "Contact us1")) {
                            echo " 
        <li class=\"cont-page\"> <a  data-target=\"#contact_page_form\" data-toggle=\"modal\" href=\"#\"  >";
                            // line 125
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["menutitle"] ?? null)), "html", null, true);
                            echo "</a>
        ";
                        } else {
                            // line 126
                            echo " 
        <li class=\"";
                            // line 127
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["item"], "in_active_trail", [])) ? ("active") : ("")));
                            echo "\">";
                            echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->env->getExtension('Drupal\Core\Template\TwigExtension')->getLink($this->sandbox->ensureToStringAllowed(($context["link_text"] ?? null)), $this->sandbox->ensureToStringAllowed($this->getAttribute($context["item"], "url", []))), "html", null, true);
                            echo "
        ";
                        }
                        // line 129
                        echo "        </li>
        
            ";
                    }
                    // line 132
                    echo "          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 133
                echo "          </ul>
         ";
                // line 134
                if ((($context["menu_level"] ?? null) == 0)) {
                    // line 135
                    echo "              
         
         <div class=\"top-sub-menu\" style=\"height: auto;\">
          <ul>
          ";
                    // line 139
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 140
                        echo "          ";
                        if ($this->getAttribute($context["item"], "in_active_trail", [])) {
                            // line 141
                            echo "          ";
                            if ($this->getAttribute($context["item"], "below", [])) {
                                // line 142
                                echo "            ";
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["item"], "below", []));
                                foreach ($context['_seq'] as $context["_key"] => $context["itemsub"]) {
                                    echo "           
              <li class=\"";
                                    // line 143
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->renderVar((($this->getAttribute($context["itemsub"], "in_active_trail", [])) ? ("active") : ("")));
                                    echo "\"><a href=\"";
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["itemsub"], "url", [])), "html", null, true);
                                    echo "\">";
                                    echo $this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed($this->getAttribute($context["itemsub"], "title", [])), "html", null, true);
                                    echo "</a></li>
            ";
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itemsub'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 145
                                echo "          ";
                            }
                            // line 146
                            echo "          ";
                        }
                        // line 147
                        echo "          ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 148
                    echo "          </ul>
        </div>  
         
          ";
                } else {
                    // line 152
                    echo "           </div>
          ";
                }
                // line 154
                echo "         
        ";
            }
            // line 156
            echo "      ";
        } catch (\Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (\Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "themes/mobile_pundits/templates/menu--main.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  442 => 156,  438 => 154,  434 => 152,  428 => 148,  422 => 147,  419 => 146,  416 => 145,  404 => 143,  397 => 142,  394 => 141,  391 => 140,  387 => 139,  381 => 135,  379 => 134,  376 => 133,  370 => 132,  365 => 129,  358 => 127,  355 => 126,  350 => 125,  345 => 124,  340 => 123,  337 => 122,  335 => 121,  332 => 120,  329 => 119,  323 => 116,  317 => 115,  314 => 114,  307 => 109,  304 => 108,  289 => 106,  285 => 104,  283 => 103,  274 => 101,  271 => 100,  267 => 98,  265 => 97,  262 => 96,  245 => 95,  242 => 94,  239 => 93,  237 => 92,  233 => 91,  224 => 87,  219 => 85,  214 => 83,  209 => 81,  206 => 80,  202 => 78,  200 => 77,  194 => 76,  190 => 75,  187 => 74,  184 => 73,  181 => 72,  176 => 71,  169 => 66,  165 => 64,  162 => 63,  159 => 62,  156 => 61,  142 => 60,  136 => 157,  130 => 58,  128 => 54,  126 => 53,  123 => 52,  117 => 48,  113 => 46,  108 => 43,  102 => 39,  83 => 23,  64 => 8,  55 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("", "themes/mobile_pundits/templates/menu--main.html.twig", "D:\\server\\Apache24\\htdocs\\drupal-893\\themes\\mobile_pundits\\templates\\menu--main.html.twig");
    }
}
