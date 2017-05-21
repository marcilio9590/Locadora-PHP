package lanchonete.model;

import java.math.BigDecimal;
import java.util.Date;
import java.util.List;

public class PedidoModel {
	private int cod_pedido;
	private ClienteModel cliente;
	private List<ProdutoModel> produtos;
	private BigDecimal total;
	private Date data_pedido;
	private int status_pedido;

	public int getCod_pedido() {
		return cod_pedido;
	}

	public void setCod_pedido(int cod_pedido) {
		this.cod_pedido = cod_pedido;
	}

	public ClienteModel getCliente() {
		return cliente;
	}

	public void setCliente(ClienteModel cliente) {
		this.cliente = cliente;
	}

	public List<ProdutoModel> getProdutos() {
		return produtos;
	}

	public void setProdutos(List<ProdutoModel> produtos) {
		this.produtos = produtos;
	}

	public BigDecimal getTotal() {
		return total;
	}

	public void setTotal(BigDecimal total) {
		this.total = total;
	}

	public Date getData_pedido() {
		return data_pedido;
	}

	public void setData_pedido(Date data_pedido) {
		this.data_pedido = data_pedido;
	}

	public int getStatus_pedido() {
		return status_pedido;
	}

	public void setStatus_pedido(int status_pedido) {
		this.status_pedido = status_pedido;
	}

}
