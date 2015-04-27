{% extends "templates/base.volt" %}

{% block content %}
    <div class="jumbotron">
        <h1>Dashboard</h1>
    </div>

    <?php echo $this->getContent(); ?>
{% endblock %}