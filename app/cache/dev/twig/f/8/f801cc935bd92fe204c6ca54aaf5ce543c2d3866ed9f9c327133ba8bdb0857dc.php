<?php

/* EduSpeakBundle:Default:index.html.twig */
class __TwigTemplate_f801cc935bd92fe204c6ca54aaf5ce543c2d3866ed9f9c327133ba8bdb0857dc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("base.html.twig", "EduSpeakBundle:Default:index.html.twig", 1);
        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_ad3ef2c2377a765d0ef6d3c4e5d2c6c73b0461a070744f09c40be13ec5e6d785 = $this->env->getExtension("native_profiler");
        $__internal_ad3ef2c2377a765d0ef6d3c4e5d2c6c73b0461a070744f09c40be13ec5e6d785->enter($__internal_ad3ef2c2377a765d0ef6d3c4e5d2c6c73b0461a070744f09c40be13ec5e6d785_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "EduSpeakBundle:Default:index.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_ad3ef2c2377a765d0ef6d3c4e5d2c6c73b0461a070744f09c40be13ec5e6d785->leave($__internal_ad3ef2c2377a765d0ef6d3c4e5d2c6c73b0461a070744f09c40be13ec5e6d785_prof);

    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        $__internal_14a9bc1b0622e43a629e0dcc652c9646a04a8dee66bf30f8ed97545380dadb32 = $this->env->getExtension("native_profiler");
        $__internal_14a9bc1b0622e43a629e0dcc652c9646a04a8dee66bf30f8ed97545380dadb32->enter($__internal_14a9bc1b0622e43a629e0dcc652c9646a04a8dee66bf30f8ed97545380dadb32_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 4
        echo "    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class=\"jumbotron\">
        <div class=\"container\">
            <h1>Welcome on EduSpeak!</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class=\"btn btn-primary btn-lg\" href=\"#\" role=\"button\">Learn more &raquo;</a></p>
        </div>
    </div>

    <div class=\"container\">
        <!-- Example row of columns -->
        <div class=\"row\">
            <div class=\"col-md-4\">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details &raquo;</a></p>
            </div>
            <div class=\"col-md-4\">
                <h2>Heading</h2>
                <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details &raquo;</a></p>
            </div>
            <div class=\"col-md-4\">
                <h2>Heading</h2>
                <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                <p><a class=\"btn btn-default\" href=\"#\" role=\"button\">View details &raquo;</a></p>
            </div>
        </div>

        <hr>

        <footer>
            <p>&copy; Company 2014</p>
        </footer>
    </div> <!-- /container -->
";
        
        $__internal_14a9bc1b0622e43a629e0dcc652c9646a04a8dee66bf30f8ed97545380dadb32->leave($__internal_14a9bc1b0622e43a629e0dcc652c9646a04a8dee66bf30f8ed97545380dadb32_prof);

    }

    public function getTemplateName()
    {
        return "EduSpeakBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 4,  34 => 3,  11 => 1,);
    }
}
