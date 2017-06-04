package lanchonete.model;

import java.math.BigDecimal;
import java.util.Date;

public class ProdutoModel {
	//Atributos referentes ao relacionamento com a tabela de itens pedido
	private int idItemPedido;
	private int cod_pedido;
	//FIM
	private String nome_produto;
	private BigDecimal preco_produto;
	private Date data_validade;
	private int quantidade;
	private int cod_produto;

	public int getCod_pedido() {
		return cod_pedido;
	}

	public void setCod_pedido(int cod_pedido) {
		this.cod_pedido = cod_pedido;
	}

	public int getIdItemPedido() {
		return idItemPedido;
	}

	public void setIdItemPedido(int idItemPedido) {
		this.idItemPedido = idItemPedido;
	}

	public String getNome_produto() {
		return nome_produto;
	}

	public void setNome_produto(String nome_produto) {
		this.nome_produto = nome_produto;
	}

	public BigDecimal getPreco_produto() {
		return preco_produto;
	}

	public void setPreco_produto(BigDecimal preco_produto) {
		this.preco_produto = preco_produto;
	}

	public Date getData_validade() {
		return data_validade;
	}

	public void setData_validade(Date data_validade) {
		this.data_validade = data_validade;
	}

	public int getQuantidade() {
		return quantidade;
	}

	public void setQuantidade(int quantidade) {
		this.quantidade = quantidade;
	}

	public int getCod_produto() {
		return cod_produto;
	}

	public void setCod_produto(int cod_produto) {
		this.cod_produto = cod_produto;
	}

}
